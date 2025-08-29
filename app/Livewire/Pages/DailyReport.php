<?php

namespace App\Livewire\Pages;

use App\Exports\SensorReadingsExport;
use App\Models\DailySensorData;
use App\Models\SensorDatas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DailyReport extends Component
{
    public $soilMoistureData=[];
    public $soilPHData=[];
    public $waterPHData=[];
    public $temperatureData=[];
    public $humidityData=[];
    
    #[Url(as: 'date')]
    public ?string $filterDate = null;

    #[Url()]
    public $selectedBoard = 'B1';

    public function mount(){
        
        $this->filterDate ??= Carbon::now('Asia/Manila')->toDateString();
       
        $this->getSoilMoistureForCurrentMonth($this->selectedBoard, $this->filterDate);
        $this->getSoilPHForCurrentMonth($this->selectedBoard, $this->filterDate);
        $this->getWaterPHForCurrentMonth($this->filterDate);
        $this->getTemperatureForCurrentMonth($this->filterDate);
        $this->getHumidityForCurrentMonth($this->filterDate);
    }

    public function exportSensorData()
    {
        $date  = $this->filterDate ?? now()->toDateString();
        $board = $this->selectedBoard ?? 'B1';

        $filename = "SensorData_{$date}_{$board}.xlsx";

        $this->dispatch('reload');

        return Excel::download(new SensorReadingsExport($date, $board), $filename);
    }
    
    public function getSoilMoistureForCurrentMonth($board, $filterDate = null)
    {
        $filterDate = $filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $moistureData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%h:%i %p") as time, soil_moisture as Value')
            ->where('board', $board)
            ->whereDate('reading_date', $filterDate)
            ->orderBy('reading_date')
            ->get();

        $this->soilMoistureData = $moistureData->map(function ($item) {
            return [
                'time' => $item->time,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }


    public function getSoilPHForCurrentMonth($board, $filterDate = null)
    {
        $filterDate = $filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $phData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%h:%i %p") as time, soil_ph as Value')
            ->where('board', $board)
            ->whereDate('reading_date', $filterDate)
            ->orderBy('reading_date')
            ->get();

        $this->soilPHData = $phData->map(function ($item) {
            return [
                'time' => $item->time,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getWaterPHForCurrentMonth($filterDate = null)
    {
        $filterDate = $filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $waterData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%h:%i %p") as time, water_ph as Value')
            ->where('board', 'B5')
            ->whereDate('reading_date', $filterDate)
            ->orderBy('reading_date')
            ->get();

        $this->waterPHData = $waterData->map(function ($item) {
            return [
                'time' => $item->time,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getTemperatureForCurrentMonth($filterDate = null)
    {
        $filterDate = $filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $tempData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%h:%i %p") as time, temperature as Value')
            ->where('board', 'B1')
            ->whereDate('reading_date', $filterDate)
            ->orderBy('reading_date')
            ->get();

        $this->temperatureData = $tempData->map(function ($item) {
            return [
                'time' => $item->time,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getHumidityForCurrentMonth($filterDate = null)
    {
        $filterDate = $filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $humidData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%h:%i %p") as time, humidity as Value')
            ->where('board', 'B1')
            ->whereDate('reading_date', $filterDate)
            ->orderBy('reading_date')
            ->get();

        $this->humidityData = $humidData->map(function ($item) {
            return [
                'time' => $item->time,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getGraphValues(){

        $date = $this->filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $this->getSoilMoistureForCurrentMonth($this->selectedBoard, $date);
        $this->getSoilPHForCurrentMonth($this->selectedBoard, $date);
        $this->getWaterPHForCurrentMonth($date);
        $this->getTemperatureForCurrentMonth($date);
        $this->getHumidityForCurrentMonth($date);

        $this->dispatch('updateChart', $this->soilMoistureData);
        $this->dispatch('updateSoilPHChart', $this->soilPHData);
        $this->dispatch('updateWaterPHChart', $this->waterPHData);
        $this->dispatch('updateTemperatureChart', $this->temperatureData);
        $this->dispatch('updateHumidityChart', $this->humidityData);
        $this->dispatch('reload'); 
    }

    public function render()
    {
        return view('livewire.pages.daily-report');
    }
}
