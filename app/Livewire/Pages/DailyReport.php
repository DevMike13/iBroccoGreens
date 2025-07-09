<?php

namespace App\Livewire\Pages;

use App\Models\DailySensorData;
use App\Models\SensorDatas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;


class DailyReport extends Component
{
    public $soilMoistureData=[];
    public $soilPHData=[];
    public $waterPHData=[];
    public $temperatureData=[];
    public $humidityData=[];
    
    #[Url(as: 'start')]
    public ?string $startDate = null;

    #[Url(as: 'end')]
    public ?string $endDate = null;

    #[Url()]
    public $selectedBoard = 'B1';

    public function mount(){
        $this->startDate ??= Carbon::now()->startOfMonth()->toDateString();
        $this->endDate ??= Carbon::now()->endOfMonth()->toDateString();
       
        $this->getSoilMoistureForCurrentMonth($this->selectedBoard, $this->startDate, $this->endDate);
        $this->getSoilPHForCurrentMonth($this->selectedBoard, $this->startDate, $this->endDate);
        $this->getWaterPHForCurrentMonth($this->startDate, $this->endDate);
        $this->getTemperatureForCurrentMonth($this->startDate, $this->endDate);
        $this->getHumidityForCurrentMonth($this->startDate, $this->endDate);
    }

    public function getSoilMoistureForCurrentMonth($board, $startDate = null, $endDate = null)
    {
        $startOfRange = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->startOfMonth();
        $endOfRange = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfMonth();

        $moistureData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, soil_moisture as Value')
            ->where('board', $board)
            ->whereBetween(DB::raw('DATE(reading_date)'), [
                $startOfRange->toDateString(),
                $endOfRange->toDateString()
            ])
            ->whereIn('id', function ($query) use ($startOfRange, $endOfRange, $board) {
                $query->selectRaw('MAX(id)')
                    ->from('daily_sensor_data')
                    ->where('board', $board)
                    ->whereBetween(DB::raw('DATE(reading_date)'), [
                        $startOfRange->toDateString(),
                        $endOfRange->toDateString()
                    ])
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

    public function getSoilPHForCurrentMonth($board, $startDate = null, $endDate = null)
    {
        $startOfRange = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->startOfMonth();
        $endOfRange = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfMonth();

        $phData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, soil_ph as Value')
            ->where('board', $board)
            ->whereBetween(DB::raw('DATE(reading_date)'), [
                $startOfRange->toDateString(),
                $endOfRange->toDateString()
            ])
            ->whereIn('id', function ($query) use ($startOfRange, $endOfRange, $board) {
                $query->selectRaw('MAX(id)')
                    ->from('daily_sensor_data')
                    ->where('board', $board)
                    ->whereBetween(DB::raw('DATE(reading_date)'), [
                        $startOfRange->toDateString(),
                        $endOfRange->toDateString()
                    ])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        $this->soilPHData = $phData->map(function ($item) {
            return [
                'Day' => $item->Day,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getWaterPHForCurrentMonth($startDate = null, $endDate = null)
    {
        $startOfRange = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->startOfMonth();
        $endOfRange = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfMonth();

        $waterData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, water_ph as Value')
            ->whereBetween(DB::raw('DATE(reading_date)'), [
                $startOfRange->toDateString(),
                $endOfRange->toDateString()
            ])
            ->whereIn('id', function ($query) use ($startOfRange, $endOfRange) {
                $query->selectRaw('MAX(id)')
                    ->from('daily_sensor_data')
                    ->whereBetween(DB::raw('DATE(reading_date)'), [
                        $startOfRange->toDateString(),
                        $endOfRange->toDateString()
                    ])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        $this->waterPHData = $waterData->map(function ($item) {
            return [
                'Day' => $item->Day,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getTemperatureForCurrentMonth($startDate = null, $endDate = null)
    {
        $startOfRange = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->startOfMonth();
        $endOfRange = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfMonth();

        $tempData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, temperature as Value')
            ->where('board', 'B1')
            ->whereBetween(DB::raw('DATE(reading_date)'), [
                $startOfRange->toDateString(),
                $endOfRange->toDateString()
            ])
            ->whereIn('id', function ($query) use ($startOfRange, $endOfRange) {
                $query->selectRaw('MAX(id)')
                    ->from('daily_sensor_data')
                    ->where('board', 'B1')
                    ->whereBetween(DB::raw('DATE(reading_date)'), [
                        $startOfRange->toDateString(),
                        $endOfRange->toDateString()
                    ])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        $this->temperatureData = $tempData->map(function ($item) {
            return [
                'Day' => $item->Day,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getHumidityForCurrentMonth($startDate = null, $endDate = null)
    {
        $startOfRange = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->startOfMonth();
        $endOfRange = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfMonth();

        $humidData = DailySensorData::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, humidity as Value')
            ->where('board', 'B1')
            ->whereBetween(DB::raw('DATE(reading_date)'), [
                $startOfRange->toDateString(),
                $endOfRange->toDateString()
            ])
            ->whereIn('id', function ($query) use ($startOfRange, $endOfRange) {
                $query->selectRaw('MAX(id)')
                    ->from('daily_sensor_data')
                    ->where('board', 'B1')
                    ->whereBetween(DB::raw('DATE(reading_date)'), [
                        $startOfRange->toDateString(),
                        $endOfRange->toDateString()
                    ])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        $this->humidityData = $humidData->map(function ($item) {
            return [
                'Day' => $item->Day,
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getGraphValues(){
        $start = $this->startDate ?? Carbon::now()->startOfMonth();
        $end = $this->endDate ?? Carbon::now()->endOfMonth();

        $this->getSoilMoistureForCurrentMonth($this->selectedBoard, $start, $end);
        $this->getSoilPHForCurrentMonth($this->selectedBoard, $start, $end);
        $this->getWaterPHForCurrentMonth($start, $end);
        $this->getTemperatureForCurrentMonth($start, $end);
        $this->getHumidityForCurrentMonth($start, $end);

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
