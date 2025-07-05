<?php

namespace App\Livewire\Pages;

use App\Models\DailySensorData;
use App\Models\SensorDatas;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;


class DailyReport extends Component
{
    public $soilMoistureData=[];

    #[Url()]
    public $selectedBoard = 'B1';

    public function mount(){
       
        $this->getSoilMoistureForCurrentMonth($this->selectedBoard);
    }

    public function getSoilMoistureForCurrentMonth($board)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $moistureData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, soil_moisture as Value')
            ->where('board', $board)
            ->whereIn('id', function ($query) use ($startOfMonth, $endOfMonth, $board) {
                $query->selectRaw('MAX(id)')
                    ->from('daily_sensor_data')
                    ->where('board', $board)
                    ->whereBetween('reading_date', [$startOfMonth, $endOfMonth])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        $this->soilMoistureData = $moistureData->map(function ($item) {
            return [
                'Day' => $item->Day,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getGraphValues(){
        $this->getSoilMoistureForCurrentMonth($this->selectedBoard);
        $this->dispatch('updateChart', $this->soilMoistureData);
        $this->dispatch('reload'); 
    }

    public function render()
    {
        return view('livewire.pages.daily-report');
    }
}
