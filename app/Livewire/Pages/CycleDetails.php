<?php

namespace App\Livewire\Pages;

use App\Models\Cycles;
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
    public $endDate;
    public $description;

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
            'endDate' => ['required', 'date', function ($attribute, $value, $fail) {
                if (strtotime($value) <= strtotime($this->startDate)) {
                    $fail('The end date must be after the start date.');
                }
            }],
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
            $previousCycle->update(['status' => 'completed']);
        }

        $newCycle = Cycles::create([
            'cycle_no' => $this->cycleNo,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'status' => 'current',
            'description' => $this->description
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
        $cycleLists = Cycles::with('harvest')->orderBy('cycle_no', 'desc')->get();
        return view('livewire.pages.cycle-details', [
            'cycleLists' => $cycleLists
        ]);
    }
}
