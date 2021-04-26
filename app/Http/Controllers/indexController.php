<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Session;

class indexController extends Controller
{
    public function index()
    {
        
        /*$role = Role::create(['name' => 'System Administrator']);
        $permission = Permission::create(['name' => 'God']);
        $role->givePermissionTo($permission); 
        $user = new User();
        $user->name = "admin";
        $user->email = "sunil.raj358@gmail.com";
        $user->email_verified_at = Carbon::now()->timestamp;
        $user->password = password_hash("1234",PASSWORD_DEFAULT);
        $user->status = "1";
        $user->save();
        $user = User::where('name','admin')->first();
        $user->assignRole('System Administrator');*/
        return view('user.index'); 
    }
}
