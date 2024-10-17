<?php

namespace App\Livewire\Pages;

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

    public $phLevelData=[
        ['Day'=>'Mon', 'Value' =>56],
        ['Day'=>'Tue', 'Value' =>32],
        ['Day'=>'Wed', 'Value' =>44],
        ['Day'=>'Thu', 'Value' =>68],
        ['Day'=>'Fri', 'Value' =>12],
        ['Day'=>'Sat', 'Value' =>86],
        ['Day'=>'Sun', 'Value' =>55],
    ];

    public $doLevelData=[
        ['Day'=>'Mon', 'Value' =>0.5],
        ['Day'=>'Tue', 'Value' =>3],
        ['Day'=>'Wed', 'Value' =>2.4],
        ['Day'=>'Thu', 'Value' =>0.6],
        ['Day'=>'Fri', 'Value' =>2],
        ['Day'=>'Sat', 'Value' =>86],
        ['Day'=>'Sun', 'Value' =>1.6],
    ];

    public $alLevelData=[
        ['Day'=>'Mon', 'Value' =>33],
        ['Day'=>'Tue', 'Value' =>74],
        ['Day'=>'Wed', 'Value' =>79],
        ['Day'=>'Thu', 'Value' =>66],
        ['Day'=>'Fri', 'Value' =>61],
        ['Day'=>'Sat', 'Value' =>82],
        ['Day'=>'Sun', 'Value' =>21],
    ];

    public $wtLevelData=[
        ['Day'=>'Mon', 'Value' =>23],
        ['Day'=>'Tue', 'Value' =>18],
        ['Day'=>'Wed', 'Value' =>30],
        ['Day'=>'Thu', 'Value' =>32],
        ['Day'=>'Fri', 'Value' =>28],
        ['Day'=>'Sat', 'Value' =>19],
        ['Day'=>'Sun', 'Value' =>36],
    ];

    public function mount(Database $database)
    {
        $this->database = $database;
        $this->fetchData();
        
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
