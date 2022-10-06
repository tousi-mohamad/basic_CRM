<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Add extends Component
{

    public $name;



    protected $rules = [
        'name' => 'required|unique:roles',
            ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.role.add');
    }

    public function add_role()
    {
        $validatedData = $this->validate();
        Role::create(['name' => $this->name]);
        $this->name = null;
        $this->emit('roleAdded');
    }

}
