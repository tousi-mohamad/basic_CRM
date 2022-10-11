<?php

namespace App\Http\Livewire\Admin;

use App\Models\Organization;
use Livewire\Component;

class Organisations extends Component
{

    public $name;
    public $plan;

    protected $rules = [
        'name'=> 'required|max:20',
        'plan'=> 'required|max:10',
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function add(){

        $validatedData = $this->validate();
        Organization::create($validatedData);
        $this->name = null;
        $this->plan = null;


    }

    public function render()
    {
        return view('livewire.admin.organisations',['organizations'=> Organization::paginate(10)]);
    }
}
