<?php

namespace App\Livewire\Pages;

use App\Models\SensorDatas;
use Carbon\Carbon;
use Livewire\Component;


class DailyReport extends Component
{
    public $phLevelData=[];
    public $doLevelData=[];
    public $alLevelData=[];
    public $wtLevelData=[];

    public function mount(){
        $this->getPHLevelDataForCurrentMonth();
        $this->getDOLevelDataForCurrentMonth();
        $this->getALLevelDataForCurrentMonth();
        $this->getWTLevelDataForCurrentMonth();
    }

    public function getPHLevelDataForCurrentMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Get only the latest dissolved oxygen level data for each day of the current month
        $phData = SensorDatas::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, ph_level as Value')
            ->whereIn('id', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->selectRaw('MAX(id)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfMonth, $endOfMonth])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        // Format the data for use in your view or chart
        $this->phLevelData = $phData->map(function ($item) {
            return [
                'Day' => $item->Day, // Use formatted date (e.g., Oct, 24)
                'Value' => round($item->Value, 2)  // Round to 2 decimal places
            ];
        })->toArray();
    }

    public function getDOLevelDataForCurrentMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Get only the latest dissolved oxygen level data for each day of the current month
        $doData = SensorDatas::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, dissolved_oxygen as Value')
            ->whereIn('id', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->selectRaw('MAX(id)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfMonth, $endOfMonth])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        // Format the data for use in your view or chart
        $this->doLevelData = $doData->map(function ($item) {
            return [
                'Day' => $item->Day, // Use formatted date (e.g., Oct, 24)
                'Value' => round($item->Value, 2)  // Round to 2 decimal places
            ];
        })->toArray();
    }

    public function getALLevelDataForCurrentMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Get only the latest dissolved oxygen level data for each day of the current month
        $alData = SensorDatas::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, alkalinity_level as Value')
            ->whereIn('id', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->selectRaw('MAX(id)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfMonth, $endOfMonth])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        // Format the data for use in your view or chart
        $this->alLevelData = $alData->map(function ($item) {
            return [
                'Day' => $item->Day, // Use formatted date (e.g., Oct, 24)
                'Value' => round($item->Value, 2)  // Round to 2 decimal places
            ];
        })->toArray();
    }

    public function getWTLevelDataForCurrentMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Get only the latest dissolved oxygen level data for each day of the current month
        $wtData = SensorDatas::selectRaw('DATE_FORMAT(reading_date, "%b, %d") as Day, water_temperature as Value')
            ->whereIn('id', function ($query) use ($startOfMonth, $endOfMonth) {
                $query->selectRaw('MAX(id)')
                    ->from('sensor_datas')
                    ->whereBetween('reading_date', [$startOfMonth, $endOfMonth])
                    ->groupByRaw('DATE(reading_date)');
            })
            ->orderBy('reading_date')
            ->get();

        // Format the data for use in your view or chart
        $this->wtLevelData = $wtData->map(function ($item) {
            return [
                'Day' => $item->Day, // Use formatted date (e.g., Oct, 24)
                'Value' => round($item->Value, 2)  // Round to 2 decimal places
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.pages.daily-report');
    }
}
