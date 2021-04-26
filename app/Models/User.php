<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Session;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function getUser(){
        $user_collection = collect();
        $user = DB::select('select TOP 1 * from hris.users where name = :name',['name' => request('username')]);
        foreach($user as $users){
            $categories->push($users); 
        }
        return $user_collection;
    }
    public static function getUserID(){
        $userid = "";
        $user = DB::select('select TOP 1 id from hris.users where name = :name',['name' => request('username')]);
        foreach($user as $users){
            $userid = $users->id; 
        }
        return $userid;
    }
    public static function hasRole($role){
        $role_bool = 0;
        $role = DB::select('select count(*) from hris.roles a join hris.model_has_roles b on a.id=b.role_id join hris.users c on c.id = b.model_id  where a.name = :name and b.model_id = :id',['name' => $role,'id' => Session::get('id')]);
        if($role > 0){
            $role_bool = 1;
        }
        return $role_bool;
    }
}
