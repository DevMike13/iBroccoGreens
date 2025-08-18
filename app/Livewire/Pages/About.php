<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('About Us')]
class About extends Component
{
    public function render()
    {
        return view('livewire.pages.about');
    }
}
