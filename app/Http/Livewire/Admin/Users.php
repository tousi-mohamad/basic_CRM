<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{



    public function role_assign_revoke($userId,$roleName){
//        dd($userId,$perName);
        $user = User::find($userId);

        if(!$user->hasRole($roleName)){ // add role
            $user->assignRole($roleName);
        }else{ //already has role so revoke
            $user->removeRole($roleName);
        }

    }
    public function per_assign_revoke($userId,$perName){
//        dd($userId,$perName);
        $user = User::find($userId);

        if(!$user->hasPermissionTo($perName)){ // add permission
            $user->givePermissionTo($perName);
        }else{ //already has permission so revoke
            $user->revokePermissionTo($perName);
        }

    }

    public function render()
    {
        return view('livewire.admin.users',['users' => User::paginate(20)]);
    }
}
