<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SearchInput extends Component
{
    public $inputName;
    public function render()
    {
        return view('livewire.components.search-input');
    }
    public function search(){
        dd($this->inputName);
        
    }
}
