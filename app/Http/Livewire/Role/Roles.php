<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $searchTerm;
    public $darkMode = 0;
    protected $listeners = [
        'roleAdded' => 'render',
        'role_table'
        ];



    public function role_table($value)
    {
        if ($value == true){
            $this->darkMode = 1;
        }else{
            $this->darkMode = 0;
        }
    }
    public function edit($itemId,$value)
    {
        Role::where('id',$itemId)->update(['name'=>$value]);
    }
    public function delete($itemId)
    {
      Role::where('id',$itemId)->delete();
      $this->render();
    }

    public function render()
    {

        $search = '%'.$this->searchTerm.'%';
        $roles = Role::where('name','LIKE',$search)
            ->orderBy('id','desc')->paginate(7);
        return view('livewire.role.roles',[
            'roles' => $roles
        ]);
    }
}
