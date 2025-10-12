<?php

namespace App\Livewire\Pages;

use App\Exports\SensorReadingsExport;
use App\Models\Cycles;
use App\Models\DailySensorData;
use App\Models\SensorDatas;
use App\Models\YieldTracker;
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

    public $soilMoistureKPI = [];
    public $soilMoistureCycleKPI = [];
    public $temperatureKPI = [];
    public $humidityKPI = [];
    public $successRateKPI = [];
    public $totalYieldKPI = [];
    
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

        $this->calculateSoilMoistureKPI($this->filterDate);
        $this->calculateTemperatureStability($this->filterDate);
        $this->calculateHumidityStability($this->filterDate);
        $this->calculateSuccessRate($this->filterDate); 
        $this->calculateTotalYields($this->filterDate);
        $this->calculateSoilMoistureForCurrentCycle($this->filterDate);
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

    public function calculateSoilMoistureKPI($filterDate = null)
    {
        $filterDate = $filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $avgMoisture = DailySensorData::whereDate('reading_date', $filterDate)
            ->avg('soil_moisture');

        $avgMoisture = round($avgMoisture, 2);

        $status = ($avgMoisture >= 40 && $avgMoisture <= 60) ? 'optimal' : 'out-of-range';

        $this->soilMoistureKPI = [
            'average' => $avgMoisture,
            'status'  => $status,
        ];
    }

    // public function calculateSoilMoistureForCurrentCycle($board)
    // {
    //     $latestCycle = Cycles::orderByDesc('cycle_no')->first();

    //     if (!$latestCycle) {
    //         $this->soilMoistureCycleKPI = [
    //             'cycle_no' => null,
    //             'average'  => 0,
    //             'status'   => 'no-data',
    //         ];
    //         return;
    //     }

    //     $avgMoisture = DailySensorData::where('board', $board)
    //         ->where('cycle_id', $latestCycle->cycle_no)
    //         ->whereBetween('reading_date', [
    //             $latestCycle->start_date,
    //             $latestCycle->end_date
    //         ])
    //         ->avg('soil_moisture');

    //     $avgMoisture = round($avgMoisture, 2);

    //     $status = ($avgMoisture >= 40 && $avgMoisture <= 60) ? 'optimal' : 'out-of-range';

    //     $this->soilMoistureCycleKPI = [
    //         'cycle_no' => $latestCycle->cycle_no,
    //         'average'  => $avgMoisture,
    //         'status'   => $status,
    //     ];
    // }

    public function calculateSoilMoistureForCurrentCycle($filterDate = null)
    {
        if ($filterDate) {
            $cycleNo = DailySensorData::whereDate('reading_date', $filterDate)
                ->value('cycle_id');

            if (!$cycleNo) {
                $this->soilMoistureCycleKPI = [
                    'cycle_no' => null,
                    'average'  => 0,
                    'status'   => 'no-data',
                ];
                return;
            }

            // Get cycle info from Cycles table (optional, if you store cycles there)
            $cycle = Cycles::where('cycle_no', $cycleNo)->first();
        } else {
            // 🔹 No filter date → use latest cycle
            $cycle = Cycles::orderByDesc('cycle_no')->first();
            $cycleNo = $cycle?->cycle_no;
        }

        if (!$cycleNo) {
            $this->soilMoistureCycleKPI = [
                'cycle_no' => null,
                'average'  => 0,
                'status'   => 'no-data',
            ];
            return;
        }

        // 🔹 Calculate avg soil moisture for that cycle_no
        $avgMoisture = DailySensorData::where('cycle_id', $cycleNo)
            ->avg('soil_moisture');

        $avgMoisture = round($avgMoisture, 2);

        $status = ($avgMoisture >= 40 && $avgMoisture <= 60) ? 'optimal' : 'out-of-range';

        $this->soilMoistureCycleKPI = [
            'cycle_no' => $cycleNo,
            'average'  => $avgMoisture,
            'status'   => $status,
        ];
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

    public function calculateTemperatureStability($filterDate = null)
    {
        $filterDate = $filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $readings = DailySensorData::where('board', 'B1')
            ->whereDate('reading_date', $filterDate)
            ->pluck('temperature')
            ->toArray();

        if (count($readings) === 0) {
            $this->temperatureKPI = [
                'avg'    => 0,
                'stddev' => 0,
                'n'      => 0,
                'status' => 'no-data',
            ];
            return;
        }

        $n = count($readings);
        $avg = array_sum($readings) / $n;

        // Calculate variance
        $variance = array_sum(array_map(fn($t) => pow($t - $avg, 2), $readings)) / $n;
        $stddev = round(sqrt($variance), 2);

        // KPI thresholds from your table
        $status = ($stddev <= 2) ? 'stable' : 'unstable';

        $this->temperatureKPI = [
            'avg'    => round($avg, 2),
            'stddev' => $stddev,
            'n'      => $n,
            'status' => $status,
        ];
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

    public function calculateHumidityStability($filterDate = null)
    {
        $filterDate = $filterDate ?? Carbon::now('Asia/Manila')->toDateString();

        $readings = DailySensorData::where('board', 'B1')
            ->whereDate('reading_date', $filterDate)
            ->pluck('humidity')
            ->toArray();

        if (count($readings) === 0) {
            $this->humidityKPI = [
                'avg'    => 0,
                'stddev' => 0,
                'n'      => 0,
                'status' => 'no-data',
            ];
            return;
        }

        $n = count($readings);
        $avg = array_sum($readings) / $n;

        // Calculate variance
        $variance = array_sum(array_map(fn($h) => pow($h - $avg, 2), $readings)) / $n;
        $stddev = round(sqrt($variance), 2);

        // KPI thresholds from your table
        $status = ($stddev <= 5) ? 'stable' : 'unstable';

        $this->humidityKPI = [
            'avg'    => round($avg, 2),
            'stddev' => $stddev,
            'n'      => $n,
            'status' => $status,
        ];
    }

    // public function calculateSuccessRate()
    // {
    //     $cycles = Cycles::with('yieldTrackers')->get();

    //     if ($cycles->isEmpty()) {
    //         $this->successRateKPI = [
    //             'rate'   => 0,
    //             'status' => 'no-data',
    //         ];
    //         return;
    //     }

    //     $totalYield   = 0;
    //     $totalTrays   = 0;

    //     foreach ($cycles as $cycle) {
    //         $totalYield += $cycle->yieldTrackers->sum('yield_per_tray');
    //         $totalTrays += $cycle->trays;
    //     }

    //     // ✅ assume each tray is expected to yield 100g (adjust as needed)
    //     $expectedYield = $totalTrays * 100;

    //     $rate = ($expectedYield > 0) ? ($totalYield / $expectedYield) * 100 : 0;
    //     $rate = round($rate, 2);

    //     $status = $rate >= 80 ? 'good' : 'poor';

    //     $this->successRateKPI = [
    //         'rate'   => $rate,
    //         'status' => $status,
    //     ];
    // }

    public function calculateSuccessRate($filterDate = null)
    {
        $this->successRateKPI = [
            'previous' => ['rate' => 0, 'status' => 'no-data'],
            'current'  => ['rate' => 0, 'status' => 'no-data'],
        ];

        if ($filterDate) {
            $filterTracker = YieldTracker::whereDate('date', $filterDate)->first();

            if ($filterTracker) {
                $filterCycle = Cycles::with('yieldTrackers')
                    ->where('cycle_no', $filterTracker->cycle_no)
                    ->first();

                if ($filterCycle) {
                    $this->successRateKPI['previous'] = $this->computeCycleSuccess($filterCycle);
                }
            }

            return; 
        }

        $latestCycle = Cycles::with('yieldTrackers')->orderBy('cycle_no', 'desc')->first();

        if (! $latestCycle) {
            return;
        }

        if ($latestCycle->status === 'current') {
            if ($latestCycle->phase !== 'germination') {
                $this->successRateKPI['current'] = $this->computeCycleSuccess($latestCycle);
            }

            $previousCycle = Cycles::with('yieldTrackers')
                ->where('cycle_no', '<', $latestCycle->cycle_no)
                ->where('status', 'completed')
                ->orderBy('cycle_no', 'desc')
                ->first();

            if ($previousCycle) {
                $this->successRateKPI['previous'] = $this->computeCycleSuccess($previousCycle);
            }
        } else {
            $this->successRateKPI['previous'] = $this->computeCycleSuccess($latestCycle);
        }
    }


    protected function computeCycleSuccess($cycle)
    {
        $totalYield = $cycle->yieldTrackers->sum('yield_per_tray');
        $totalTrays = $cycle->trays;

        $expectedYield = $totalTrays * 100; 
        $rate = ($expectedYield > 0) ? ($totalYield / $expectedYield) * 100 : 0;
        $rate = round($rate, 2);

        $status = $rate >= 80 ? 'good' : 'poor';

        return [
            'rate'   => $rate,
            'status' => $status,
            'cycle'  => $cycle->cycle_no,
        ];
    }


    // public function calculateTotalYields()
    // {
    //     $total = 0;

    //     $latestCycle = Cycles::orderBy('cycle_no', 'desc')->first();

    //     if ($latestCycle) {
    //         if ($latestCycle->status === 'current') {
    //             $previousCycle = Cycles::where('cycle_no', '<', $latestCycle->cycle_no)
    //                 ->where('status', 'completed')
    //                 ->orderBy('cycle_no', 'desc')
    //                 ->first();

    //             if ($previousCycle) {
    //                 $total = $previousCycle->yieldTrackers()->sum('yield_per_tray');
    //             }
    //         } else {
    //             $total = $latestCycle->yieldTrackers()->sum('yield_per_tray');
    //         }
    //     }

    //     $this->totalYieldKPI = [
    //         'total' => $total,
    //         'unit'  => 'g',
    //     ];
    // }

    // public function calculateTotalYields()
    // {
    //     $currentTotal  = 0;
    //     $previousTotal = 0;
    
    //     $currentCycle = Cycles::where('status', 'current')
    //         ->orderBy('cycle_no', 'desc')
    //         ->first();
    
    //     if ($currentCycle) {
        
    //         $currentTotal = $currentCycle->yieldTrackers()->sum('yield_per_tray');
    
    //         $previousCycle = Cycles::where('cycle_no', '<', $currentCycle->cycle_no)
    //             ->where('status', 'completed')
    //             ->orderBy('cycle_no', 'desc')
    //             ->first();
    
    //         if ($previousCycle) {
    //             $previousTotal = $previousCycle->yieldTrackers()->sum('yield_per_tray');
    //         }
    //     }
    
    //     $this->totalYieldKPI = [
    //         'current'  => $currentTotal,
    //         'previous' => $previousTotal,
    //         'unit'     => 'g',
    //     ];
    // }

    public function calculateTotalYields($filterDate = null)
    {
        $currentTotal  = 0;
        $previousTotal = 0;

        $currentCycle = Cycles::where('status', 'current')
            ->orderBy('cycle_no', 'desc')
            ->first();

        if ($currentCycle) {
            $currentTotal = $currentCycle->yieldTrackers()->sum('yield_per_tray');

            if ($filterDate) {
                $filterTracker = YieldTracker::whereDate('date', $filterDate)->first();

                if ($filterTracker) {
                    $filterCycle = Cycles::where('cycle_no', $filterTracker->cycle_no)->first();

                    if ($filterCycle) {
                        $previousTotal = $filterCycle->yieldTrackers()->sum('yield_per_tray');
                    }
                }
            } else {
                $previousCycle = Cycles::where('cycle_no', '<', $currentCycle->cycle_no)
                    ->where('status', 'completed')
                    ->orderBy('cycle_no', 'desc')
                    ->first();

                if ($previousCycle) {
                    $previousTotal = $previousCycle->yieldTrackers()->sum('yield_per_tray');
                }
            }
        } else {
            $previousCycle = Cycles::where('status', 'completed')
                ->orderBy('cycle_no', 'desc')
                ->first();
    
            if ($previousCycle) {
                $previousTotal = $previousCycle->yieldTrackers()->sum('yield_per_tray');
            }
        }

        $this->totalYieldKPI = [
            'current'  => $currentTotal,
            'previous' => $previousTotal,
            'unit'     => 'g',
        ];
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
