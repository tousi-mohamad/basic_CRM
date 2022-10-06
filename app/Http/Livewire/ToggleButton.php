<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class ToggleButton extends Component
{
//    public Model $model;

    public $hasStock;
    public $parent;

    public function mount()
    {
//        $this->hasStock = (bool) $this->model->getAttribute($this->field);
    }
    public function render()
    {
        return view('livewire.toggle-button');
    }
    public function updating($field, $value)
    {

        $this->emit($this->parent , $value);

    }
}
