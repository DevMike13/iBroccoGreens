<?php

namespace App\Livewire\Pages;

use Livewire\Component;


class DailyReport extends Component
{
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

    public function render()
    {
        return view('livewire.pages.daily-report');
    }
}
