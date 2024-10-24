<?php

namespace App\Livewire\Pages;

use App\Models\Cycles;
use App\Models\Harvests;
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
    public $editHarvestDate;
    public $editHarvestWeight;
    public $status;

    public $selectedCycleToHarvestId;
    public $harvestCycleNo;
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
        // Get the latest cycle based on cycle_no
        $previousCycle = Cycles::latest('cycle_no')->first();

        // Check if there is a previous cycle and if it meets the conditions
        if ($previousCycle && $previousCycle->status == 'completed' && $previousCycle->end_date != null) {
            // Create a new cycle
            $newCycle = Cycles::create([
                'cycle_no' => $this->cycleNo,
                'start_date' => $this->startDate,
                'status' => 'current',
                'description' => $this->description,
            ]);

            // Create the shrimp record for the new cycle
            Shrimps::create([
                'cycle_id' => $newCycle->id,
                'shrimp_count' => $this->shrimpCount,
            ]);

            // Set the Firebase current cycle number
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
                'start_date' => $this->startDate,
                'status' => 'current',
                'description' => $this->description,
            ]);

            Shrimps::create([
                'cycle_id' => $newCycle->id,
                'shrimp_count' => $this->shrimpCount,
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
        $cycle = Cycles::with(['shrimp', 'harvest'])->findOrFail($id);

        if($cycle && $id){
            $this->selectedCycleId = $id;
            $this->editCycleNo = $cycle->cycle_no;
            $this->editStartDate = $cycle->start_date;
            $this->editShrimpCount = $cycle->shrimp->shrimp_count;
            $this->editDescription = $cycle->description;
            $this->status = $cycle->status;
            if($cycle->harvest != null && $cycle->status == 'completed'){
                $this->editHarvestDate = $cycle->harvest->date_harvested;
                $this->editHarvestWeight = $cycle->harvest->harvest_count;
            }
            
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

            $harvest = Harvests::where('cycle_id', $id);

            $harvest->update([
                'harvest_count' => $this->editHarvestWeight,
                'date_harvested' => $this->editHarvestDate
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
        $this->editShrimpCount = "";
        $this->editDescription = "";
        $this->editHarvestDate = "";
        $this->editHarvestWeight = "";
        $this->status = "";
    }

    public function getSelectedHarvestCycle($id){
        $harvestCycle = Cycles::findOrFail($id);

        if($harvestCycle && $id){
            $this->selectedCycleToHarvestId = $id;
            $this->harvestCycleNo = $harvestCycle->cycle_no;
        }
    }

    public function harvest($id){
        $cycle = Cycles::findOrFail($id);

        $this->validate([ 
            'harvestDate' => 'required|date',
            'harvestWeight' => 'required|integer',
        ]);

        if ($cycle && $id) {
            $cycle->update([
                'status' => 'completed',
                'end_date' => $this->harvestDate
            ]);

            $harvest = Harvests::create([
                'cycle_id' => $id,
                'harvest_count' => $this->harvestWeight,
                'date_harvested' => $this->harvestDate
            ]);

            Notification::make()
                ->title('Success!')
                ->body('Cycle has been harvested.')
                ->success()
                ->send();
        }

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function harvestCycleConfirmation($id){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to harvest this cycle with Cycle No. ".  html_entity_decode('<span class="text-red-600 underline">' . $this->harvestCycleNo . '</span>') . " ?",
            'acceptLabel' => 'Yes, harvest it',
            'method'      => 'harvest',
            'icon'        => 'error',
            'params'      => $id
        ]);
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
