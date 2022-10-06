<?php

namespace App\Http\Livewire\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{

    public $darkMode;
    public $searchTerm;
    protected $listeners = [
        'permissionAdded' => 'render',
        'permission_table'
    ];



    public function permission_table($value)
    {
        if ($value == true){
            $this->darkMode = 1;
        }else{
            $this->darkMode = 0;
        }
    }
    public function updateDarkMode($value)
    {
        dd($value);
    }
    public function edit($itemId,$value)
    {
        Permission::where('id',$itemId)->update(['name'=>$value]);
    }
    public function delete($itemId)
    {
        Permission::where('id',$itemId)->delete();
        $this->render();
    }

    public function render()
    {

        $search = '%'.$this->searchTerm.'%';
        $permissions = Permission::where('name','LIKE',$search)
        ->orderBy('id','desc')->paginate(7);

        return view('livewire.permission.permissions',[
        'permissions' => $permissions
        ]);
    }
}
