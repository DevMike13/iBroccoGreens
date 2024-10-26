<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Kreait\Firebase\Contract\Database;

class ManualControls extends Component
{
    protected Database $database;

    public $feedingState;
    public bool $isActiveFeeding;

    public $solutionState;
    public bool $isActiveSolution;

    public $wheelState;
    public bool $isActiveWheel;

    public $waterReleaseState;
    public bool $isActiveWaterRelease;

    public $waterRefillState;
    public bool $isActiveWaterRefill;

    public function mount(Database $database){
        $this->database = $database;
        $this->getFeedingState();
        $this->getSolutionState();
        $this->getWheelState();
        $this->getWaterRelasesState();
        $this->getWaterRefillState();
    }

    // FEEDING
    public function getFeedingState()
    {
        try {
            $reference = $this->database->getReference('/FeedingState');
            $currentData = $reference->getValue();

            // Set the properties based on the retrieved value
            if ($currentData == 'ON') {
                $this->feedingState = 'ON';
                $this->isActiveFeeding = true;
            } else {
                $this->feedingState = 'OFF';
                $this->isActiveFeeding = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleFeeding(Database $database)
    {
        $this->database = $database;
        try {
            $reference = $this->database->getReference('/FeedingState');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->feedingState = 'ON';
                $this->isActiveFeeding = true;
            } else {
                $this->feedingState = 'OFF';
                $this->isActiveFeeding = false;
            }

            $reference->set($this->feedingState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    // SOLUTION
    public function getSolutionState()
    {
        try {
            $reference = $this->database->getReference('/SolutionState');
            $currentData = $reference->getValue();

            // Set the properties based on the retrieved value
            if ($currentData == 'ON') {
                $this->solutionState = 'ON';
                $this->isActiveSolution = true;
            } else {
                $this->solutionState = 'OFF';
                $this->isActiveSolution = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleSolution(Database $database)
    {
        $this->database = $database;
        try {
            $reference = $this->database->getReference('/SolutionState');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->solutionState = 'ON';
                $this->isActiveSolution = true;
            } else {
                $this->solutionState = 'OFF';
                $this->isActiveSolution = false;
            }

            $reference->set($this->solutionState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    // WHEEL
    public function getWheelState()
    {
        try {
            $reference = $this->database->getReference('/WheelState');
            $currentData = $reference->getValue();

            // Set the properties based on the retrieved value
            if ($currentData == 'ON') {
                $this->wheelState = 'ON';
                $this->isActiveWheel = true;
            } else {
                $this->wheelState = 'OFF';
                $this->isActiveWheel = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleWheel(Database $database)
    {
        $this->database = $database;
        try {
            $reference = $this->database->getReference('/WheelState');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->wheelState = 'ON';
                $this->isActiveWheel = true;
            } else {
                $this->wheelState = 'OFF';
                $this->isActiveWheel = false;
            }

            $reference->set($this->wheelState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    // WATER RELEASE
    public function getWaterRelasesState()
    {
        try {
            $reference = $this->database->getReference('/WaterReleaseState');
            $currentData = $reference->getValue();

            // Set the properties based on the retrieved value
            if ($currentData == 'ON') {
                $this->waterReleaseState = 'ON';
                $this->isActiveWaterRelease = true;
            } else {
                $this->waterReleaseState = 'OFF';
                $this->isActiveWaterRelease = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleWaterRelease(Database $database)
    {
        $this->database = $database;
        try {
            $reference = $this->database->getReference('/WaterReleaseState');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->waterReleaseState = 'ON';
                $this->isActiveWaterRelease = true;
            } else {
                $this->waterReleaseState = 'OFF';
                $this->isActiveWaterRelease = false;
            }

            $reference->set($this->waterReleaseState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    // WATER REFILL
    public function getWaterRefillState()
    {
        try {
            $reference = $this->database->getReference('/WaterRefillState');
            $currentData = $reference->getValue();

            // Set the properties based on the retrieved value
            if ($currentData == 'ON') {
                $this->waterRefillState = 'ON';
                $this->isActiveWaterRefill = true;
            } else {
                $this->waterRefillState = 'OFF';
                $this->isActiveWaterRefill = false;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error retrieving status: ' . $e->getMessage()], 500);
        }
    }

    public function toggleWaterRefill(Database $database)
    {
        $this->database = $database;
        try {
            $reference = $this->database->getReference('/WaterRefillState');
            
            $currentData = $reference->getValue();
            
            if ($currentData == 'OFF') {
                $this->waterRefillState = 'ON';
                $this->isActiveWaterRefill = true;
            } else {
                $this->waterRefillState = 'OFF';
                $this->isActiveWaterRefill = false;
            }

            $reference->set($this->waterRefillState);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error toggling status: ' . $e->getMessage()], 500);
        }
    }

    public function render()
    {
        return view('livewire.pages.manual-controls');
    }
}
