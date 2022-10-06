<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Add extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|unique:permissions',
    ];

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function add_permission()
    {
        $validatedData = $this->validate();
        Permission::create(['name' => $this->name]);
        $this->name = null;
        $this->emit('permissionAdded');
    }


    public function render()
    {
        return view('livewire.permission.add');
    }
}
