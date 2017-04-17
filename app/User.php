<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany("App\\Role");
    }

    public function isEmployee() 
    {
        return ($this->roles()->count()) ? true : false;
    }

    public function hasRole($role)
    {
        return $this->roles->pluck("name")->contains($role);
    }

    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value){
            if($value == $term){
                return $key;
                dd($key);
            }
        }
        // throw new \UnexpectedValueException('ss');
    }

    public function makeEmployee($title)
    {   
        $assigned_roles = array();
        $roles = Role::all()->pluck("name", "id");

        switch($title) {
            case 'super_admin':
                $assigned_roles[] = $this->getIdInArray($roles, 'create');
                $assigned_roles[] = $this->getIdInArray($roles, 'update');
            case 'admin':
                $assigned_roles[] = $this->getIdInArray($roles, 'delete');
                $assigned_roles[] = $this->getIdInArray($roles, 'ban');
            case 'moderator':
                $assigned_roles[] = $this->getIdInArray($roles, 'kickass');
                $assigned_roles[] = $this->getIdInArray($roles, 'lemon');
                break;
            default:
                throw new \Exception("The employee status entered does not exists");
        }

        $this->roles()->sync($assigned_roles);
    }
}
