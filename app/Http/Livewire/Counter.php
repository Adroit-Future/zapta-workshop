<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $name = "M Usman";
    public function render()
    {
        return view('livewire.counter');
    }
}
