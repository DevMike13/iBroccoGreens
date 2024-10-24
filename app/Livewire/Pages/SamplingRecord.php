<?php

namespace App\Livewire\Pages;

use Livewire\Component;

use App\Models\Cycles;
use App\Models\Harvests;
use App\Models\Samplings;
use App\Models\Shrimps;
use Filament\Notifications\Notification;
use Kreait\Firebase\Contract\Database;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class SamplingRecord extends Component
{
    use Actions;
    use WithPagination;

    public $cycleNo;
    public $samplingNo;
    public $samplingDate;
    public $averageWeight;

    public $selectedSamplingId;
    public $editCycleNo;
    public $editSamplingNo;
    public $editSamplingDate;
    public $editAverageWeight;

    public function createNewSampling(){
        
        $this->validate([ 
            'cycleNo' => 'required|integer|min:1',
            'samplingNo'=> 'required|integer|min:1',
            'samplingDate' => 'required|date',
            'averageWeight' => 'required|integer|min:1',
        ]);

        $newSampling = Samplings::create([
            'cycle_no' => $this->cycleNo,
            'sampling_no' => $this->samplingNo,
            'date' => $this->samplingDate,
            'average_weight' => $this->averageWeight
        ]);

        Notification::make()
            ->title('Success!')
            ->body('Sampling has been created.')
            ->success()
            ->send();
        

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function cancelCreate(){
        $this->cycleNo = "";
        $this->samplingNo = "";
        $this->samplingDate = "";
        $this->averageWeight = "";
    }

    // EDIT
    public function getSelectedSampling($id){
        $sampling = Samplings::findOrFail($id);

        if($sampling && $id){
            $this->selectedSamplingId = $id;
            $this->editCycleNo = $sampling->cycle_no;
            $this->editSamplingNo = $sampling->sampling_no;
            $this->editSamplingDate = $sampling->date;
            $this->editAverageWeight = $sampling->average_weight;
        
        }
    }

    public function editSelectedSampling($id){
        if($this->selectedSamplingId){
            $this->validate([ 
                'editCycleNo' => 'required|integer|min:1',
                'editSamplingNo'=> 'required|integer|min:1',
                'editSamplingDate' => 'required|date',
                'editAverageWeight' => 'required|integer|min:1',
            ]);
    
            $sampling = Samplings::findOrFail($id);
    
            $sampling->update([
                'cycle_no' => $this->editCycleNo,
                'sampling_no' => $this->editSamplingNo,
                'date' => $this->editSamplingDate,
                'average_weight' => $this->editAverageWeight,
            ]);

            Notification::make()
                ->title('Success!')
                ->body('Sampling has been updated.')
                ->success()
                ->send();

            $this->cancelEdit();
            $this->dispatch('reload');

            return redirect()->back();
        }
    }

    public function editSamplingConfirmation($id){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to edit this sampling with Sampling No. ".  html_entity_decode('<span class="text-red-600 underline">' . $this->editSamplingNo . '</span>') . " ?",
            'acceptLabel' => 'Yes, update it',
            'method'      => 'editSelectedSampling',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function cancelEdit(){
        $this->selectedSamplingId = "";
        $this->editCycleNo = "";
        $this->editSamplingNo = "";
        $this->editSamplingDate = "";
        $this->editAverageWeight = "";
    }

    // DELETE
    public function deleteSampling($id){
        $sampling = Samplings::findOrFail($id);
        $sampling->delete();

        Notification::make()
            ->title('Success!')
            ->body('Sampling has been deleted.')
            ->success()
            ->send();

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function deleteSamplingConfirmation($id, $samplingNo){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this sampling with Sampling No. ".  html_entity_decode('<span class="text-red-600 underline">' . $samplingNo . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteSampling',
            'icon'        => 'error',
            'params'      => $id
        ]);
    }

    public function render()
    {
        $samplingLists = Samplings::get();
        return view('livewire.pages.sampling-record', [
            'samplingLists' =>  $samplingLists
        ]);
    }
}
