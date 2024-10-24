<?php

namespace App\Livewire\Pages;

use App\Models\SensorDatas;
use Carbon\Carbon;
use Livewire\Component;
use Kreait\Firebase\Contract\Database;

class Dashboard extends Component
{
    protected Database $database;
    public $phData;

    public $doData;

    public $alData;

    public $wTempData;

    protected $listeners = [
        'updatePhLevel' => 'handlePhLevelUpdate',
        'updateDOLevel' => 'handleDoLevelUpdate',
        'updateALLevel' => 'handleAlLevelUpdate',
        'updateWTLevel' => 'handleWtLevelUpdate'
    ];

    public $phLevelData = [];
    public $doLevelData = [];
    public $alLevelData=[];
    public $wtLevelData=[];

    public function mount(Database $database)
    {
        $this->database = $database;
        $this->fetchData();
        $this->getPhLevelDataForCurrentWeek();
        $this->getDOLevelDataForCurrentWeek();
        $this->getAlLevelDataForCurrentWeek();
        $this->getWtDataForCurrentWeek();
        
    }

    public function getPhLevelDataForCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $phData = SensorDatas::selectRaw('DAYNAME(reading_date) as Day, ph_level as Value')
            ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
            ->whereIn('reading_date', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->selectRaw('MAX(reading_date)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderByRaw('FIELD(Day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        $this->phLevelData = $phData->map(function ($item) {
            return [
                'Day' => substr($item->Day, 0, 3),
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getDOLevelDataForCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $doData = SensorDatas::selectRaw('DAYNAME(reading_date) as Day, dissolved_oxygen as Value')
            ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
            ->whereIn('reading_date', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->selectRaw('MAX(reading_date)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderByRaw('FIELD(Day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        $this->doLevelData = $doData->map(function ($item) {
            return [
                'Day' => substr($item->Day, 0, 3),
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }
    
    public function getAlLevelDataForCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $alData = SensorDatas::selectRaw('DAYNAME(reading_date) as Day, alkalinity_level as Value')
            ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
            ->whereIn('reading_date', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->selectRaw('MAX(reading_date)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderByRaw('FIELD(Day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        $this->alLevelData = $alData->map(function ($item) {
            return [
                'Day' => substr($item->Day, 0, 3),
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function getWtDataForCurrentWeek()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $wtData = SensorDatas::selectRaw('DAYNAME(reading_date) as Day, water_temperature as Value')
            ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
            ->whereIn('reading_date', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->selectRaw('MAX(reading_date)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfWeek, $endOfWeek])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderByRaw('FIELD(Day, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        $this->wtLevelData = $wtData->map(function ($item) {
            return [
                'Day' => substr($item->Day, 0, 3),
                'Value' => round($item->Value, 2)
            ];
        })->toArray();
    }

    public function fetchData()
    {
        try {
            // PH
            $referencePH = $this->database->getReference('pHLevel/phLevel');  // Example path
            $snapshotPH = $referencePH->getSnapshot();
            $this->phData = $snapshotPH->getValue();


            // DISSOLVED OXYGEN
            $referenceDO = $this->database->getReference('DissolvedOxygen/DO');  // Example path
            $snapshotDO = $referenceDO->getSnapshot();
            $this->doData = $snapshotDO->getValue();


            // ALKALINITY LEVEL
            $referenceAL = $this->database->getReference('AlkalinityLevel/AL');  // Example path
            $snapshotAL = $referenceAL->getSnapshot();
            $this->alData = $snapshotAL->getValue();


            // WATER TEMPERATURE
            $referenceWT = $this->database->getReference('WaterTemperature/Temperature');  // Example path
            $snapshotWT = $referenceWT->getSnapshot();
            $this->wTempData = $snapshotWT->getValue();


        } catch (\Exception $e) {
            $this->phData = 'Error: ' . $e->getMessage();
        }
    }

    public function handlePhLevelUpdate($phLevel)
    {
        $this->phData = $phLevel;
    }

    public function handleDoLevelUpdate($doLevel)
    {
        $this->doData = $doLevel;
    }

    public function handleAlLevelUpdate($alLevel)
    {
        $this->alData = $alLevel;
    }

    public function handleWtLevelUpdate($wtLevel)
    {
        $this->wTempData = $wtLevel;
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard', [
            'pHLevel' => $this->phData,
            'DissolvedOxygen' => $this->doData,
            'AlkalinityLevel' => $this->alData,
            'WaterTemperature' => $this->wTempData,
        ]);
    }
}
