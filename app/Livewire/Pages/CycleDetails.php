<?php

namespace App\Livewire\Pages;

use App\Models\Cycles;
use App\Models\Harvests;
use App\Models\Shrimps;
use Carbon\Carbon;
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
    public $microgreenType;
    public $startDate;
    public $endDate;
    public $trays;
    public $expectedYield;
    public $notes;
   
    public $selectedCycleId;
    public $editCycleNo;
    public $editMicrogreenType;
    public $editStartDate;
    public $editEndDate;
    public $editTrays;
    public $editExpectedYield;
    public $editNotes;
    public $status;

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
            'microgreenType' => 'required',
            'trays' => 'required|integer',
            'notes' => 'required',
        ]);

        if ($this->cycleNo > 1) {

            $this->createCycleConfirmation($this->cycleNo);

        } else {
            $this->saveCycle($database);
        }
        

    }

    public function saveCycle(Database $database)
    {
        // Get the latest cycle based on cycle_no
        $previousCycle = Cycles::latest('cycle_no')->first();

        // Check if there is a previous cycle and if it meets the conditions
        if ($previousCycle && $previousCycle->status == 'completed' && $previousCycle->end_date != null) {
            // Create a new cycle
            $newCycle = Cycles::create([
                'cycle_no' => $this->cycleNo,
                'microgreen_type' => $this->microgreenType,
                'start_date' => $this->startDate,
                'trays' => $this->trays,
                'expected_yield' => $this->expectedYield,
                'notes' => $this->notes,
                'status' => 'current',
            ]);

            $this->database = $database;
            $this->setFirebaseCurrentCycleNo();

            // Success notification
            Notification::make()
                ->title('Success!')
                ->body('Cycle has been created.')
                ->success()
                ->send();
        } 
        // Handle the case where there's no previous cycle or an active cycle exists
        else if (!$previousCycle) {
            // If no previous cycle, create a new cycle directly
            $newCycle = Cycles::create([
                'cycle_no' => $this->cycleNo,
                'microgreen_type' => $this->microgreenType,
                'start_date' => $this->startDate,
                'trays' => $this->trays,
                'expected_yield' => $this->expectedYield,
                'notes' => $this->notes,
                'status' => 'current',
            ]);

            $this->database = $database;
            $this->setFirebaseCurrentCycleNo();

            Notification::make()
                ->title('Success!')
                ->body('First cycle has been created.')
                ->success()
                ->send();
        } else {
            // Error notification when an active cycle already exists
            Notification::make()
                ->title('Error!')
                ->body("There's an active cycle. Harvest it first before you can create a new cycle.")
                ->danger()
                ->send();
        }

        // Reload the page or component
        $this->dispatch('reload');

        // Redirect back to the previous page
        return redirect()->back();
    }


    public function createCycleConfirmation($newCycleNo){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to create this cycle No. ".  html_entity_decode('<span class="text-red-600 underline">' . $newCycleNo . '</span>') . " ?",
            'acceptLabel' => 'Yes, create it',
            'method'      => 'saveCycle',
            'icon'        => 'error',
            'params'      => $newCycleNo
        ]);
    }

    public function getSelectedCycle($id){
        $cycle = Cycles::findOrFail($id);

        if($cycle && $id){
            $this->selectedCycleId = $id;
            $this->editCycleNo = $cycle->cycle_no;
            $this->editStartDate = $cycle->start_date;
            $this->editMicrogreenType = $cycle->microgreen_type;
            $this->editEndDate = $cycle->end_date;
            $this->editTrays = $cycle->trays;
            $this->editExpectedYield = $cycle->expected_yield;
            $this->editNotes = $cycle->notes;
            $this->status = $cycle->status;
            
        }
    }

    public function editSelectedCycle($id){
        if($this->selectedCycleId){
            $this->validate([
                'editCycleNo' => 'required|integer',
                'editStartDate' => 'required|date',
                'editMicrogreenType'  => 'required',
                'editEndDate' => 'nullable|date',
                'editTrays' => 'required|integer',
                'editExpectedYield' => 'nullable|integer',
                'editNotes' => 'required',
                'status' => 'required',
            ]);
    
            $cycle = Cycles::findOrFail($id);

            $endDate = $this->status === 'completed'
                ? now()->format('Y-m-d') 
                : $this->editEndDate;
    
            $cycle->update([
                'microgreen_type' => $this->editMicrogreenType,
                'start_date' => $this->editStartDate,
                'end_date' => $endDate,
                'trays' => $this->editTrays,
                'expected_yield' => $this->editExpectedYield,
                'notes' => $this->editNotes,
                'status' => $this->status
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
            'acceptLabel' => 'Yes, update it',
            'method'      => 'editSelectedCycle',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function cancelEdit(){
        $this->selectedCycleId = "";
        $this->editCycleNo = "";
        $this->editStartDate = "";
        $this->editEndDate = "";
        $this->editMicrogreenType = "";
        $this->editTrays = "";
        $this->editExpectedYield = "";
        $this->editNotes = "";
        $this->status = "";
    }

    public function deleteCycle($id){
        $cycle = Cycles::findOrFail($id);
        $cycle->delete();

        Notification::make()
            ->title('Success!')
            ->body('Cycle has been deleted.')
            ->success()
            ->send();

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function deleteCycleConfirmation($id, $cycleNo){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this cycle with Cycle No. ".  html_entity_decode('<span class="text-red-600 underline">' . $cycleNo . '</span>') . " ? This will delete all data such as sensors data.",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteCycle',
            'icon'        => 'error',
            'params'      => $id
        ]);
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

            $startDate = Carbon::parse($this->startDate);

            $this->database->getReference('/CycleStartMonth')->set($startDate->format('m'));
            $this->database->getReference('/CycleStartDay')->set($startDate->format('d'));
            $this->database->getReference('/CycleStartYear')->set($startDate->format('Y'));

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error setting data: ' . $e->getMessage()], 500);
        }
    }
    
    public function render()
    {
        $cycleLists = Cycles::orderBy('cycle_no', 'desc')->get();
        return view('livewire.pages.cycle-details', [
            'cycleLists' => $cycleLists
        ]);
    }
}
