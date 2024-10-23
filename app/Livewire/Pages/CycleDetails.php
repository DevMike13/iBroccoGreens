<?php

namespace App\Livewire\Pages;

use App\Models\Cycles;
use App\Models\Shrimps;
use Filament\Notifications\Notification;
use Kreait\Firebase\Contract\Database;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CycleDetails extends Component
{
    use Actions;
    use WithPagination;
    protected Database $database;

    public $currentCycleNo;
    
    public $cycleNo;
    public $startDate;
    public $shrimpCount;
    public $description;

    public $selectedCycleId;
    public $editCycleNo;
    public $editStartDate;
    public $editShrimpCount;
    public $editDescription;

    public $harvestDate;
    public $harvestWeight;

    public function getCycleNumber(Database $database){
        $latestCycle = Cycles::latest('cycle_no')->first();
        $this->cycleNo = $latestCycle ? $latestCycle->cycle_no + 1 : 1;

        $this->database = $database;
        $this->fetchFirebaseCurrentCycle();
    }

    public function createNewCycle(Database $database){
        
        $this->validate([ 
            'cycleNo' => 'required|integer',
            'startDate' => 'required|date',
            // 'endDate' => ['required', 'date', function ($attribute, $value, $fail) {
            //     if (strtotime($value) <= strtotime($this->startDate)) {
            //         $fail('The end date must be after the start date.');
            //     }
            // }],
            'description' => 'required|max:255',
        ]);

        if ($this->cycleNo > 1) {

            $this->createCycleConfirmation($this->cycleNo);

        } else {
            $this->saveCycle($database);
        }
        

    }

    public function saveCycle(Database $database)
    {
        $previousCycle = Cycles::latest('cycle_no')->first();

        if ($previousCycle) {
            $previousCycle->update([
                'status' => 'completed',
                'end_date' => now()
            ]);
        }

        $newCycle = Cycles::create([
            'cycle_no' => $this->cycleNo,
            'start_date' => $this->startDate,
            // 'end_date' => $this->endDate,
            'status' => 'current',
            'description' => $this->description
        ]);
        
        $shrimpForTheCycle = Shrimps::create([
            'cycle_id' => $newCycle->id,
            'shrimp_count' => $this->shrimpCount
        ]);

        $this->database = $database;
        $this->setFirebaseCurrentCycleNo();

        Notification::make()
            ->title('Success!')
            ->body('Cycle has been created.')
            ->success()
            ->send();

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function createCycleConfirmation($newCycleNo){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to create this cycle No. ".  html_entity_decode('<span class="text-red-600 underline">' . $newCycleNo . '</span>') . " it will end the previous cycle?",
            'acceptLabel' => 'Yes, create it',
            'method'      => 'saveCycle',
            'icon'        => 'error',
            'params'      => $newCycleNo
        ]);
    }

    public function getSelectedCycle($id){
        $cycle = Cycles::with('shrimp')->findOrFail($id);

        if($cycle && $id){
            $this->selectedCycleId = $id;
            $this->editCycleNo = $cycle->cycle_no;
            $this->editStartDate = $cycle->start_date;
            $this->editShrimpCount = $cycle->shrimp->shrimp_count;
            $this->editDescription = $cycle->description;
        }
    }

    public function editSelectedCycle($id){
        if($this->selectedCycleId){
            $this->validate([
                'editCycleNo' => 'required|integer',
                'editStartDate' => 'required|date',
                'editShrimpCount'  => 'required|integer|min:1',
                'editDescription' => 'required|max:255'
            ]);
    
            $cycle = Cycles::findOrFail($id);
    
            $cycle->update([
                'start_date' => $this->editStartDate,
                'description' => $this->editDescription,
            ]);

            $shrimp = Shrimps::where('cycle_id', $id);

            $shrimp->update([
                'shrimp_count' => $this->editShrimpCount
            ]);

            Notification::make()
                ->title('Success!')
                ->body('Cycle has been updated.')
                ->success()
                ->send();

            $this->cancelEdit();
            $this->dispatch('reload');

            return redirect()->back();
        }
    }

    public function editCycleConfirmation($id){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to edit this cycle with ID No. ".  html_entity_decode('<span class="text-red-600 underline">' . $id . '</span>') . " ?",
            'acceptLabel' => 'Yes, create it',
            'method'      => 'editSelectedCycle',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function cancelEdit(){
        $this->selectedCycleId = "";
        $this->editCycleNo = "";
        $this->editStartDate = "";
        $this->editShrimpCount = "";
        $this->editDescription = "";
    }

    public function getSelectedHarvestCycle($id){
        $harvestCycle = Cycles::findOrFail($id);

        if($harvestCycle && $id){
            $this->selectedCycleId = $id;
            $this->editCycleNo = $harvestCycle->cycle_no;
        }
    }

    public function fetchFirebaseCurrentCycle()
    {
        try {
            $reference = $this->database->getReference('/CurrentCycleNo');
            $snapshot = $reference->getSnapshot();
            $this->currentCycleNo = $snapshot->getValue();

        } catch (\Exception $e) {
            $this->currentCycleNo = 'Error: ' . $e->getMessage();
        }
    }

    public function setFirebaseCurrentCycleNo(){
        try {
            $referenceCycle = $this->database->getReference('/CurrentCycleNo');
            $cycleValue = (int) $this->cycleNo;
            $referenceCycle->set($cycleValue); 
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error setting data: ' . $e->getMessage()], 500);
        }
    }
    
    public function render()
    {
        $cycleLists = Cycles::with(['harvest' , 'shrimp'])->orderBy('cycle_no', 'desc')->get();
        return view('livewire.pages.cycle-details', [
            'cycleLists' => $cycleLists
        ]);
    }
}
