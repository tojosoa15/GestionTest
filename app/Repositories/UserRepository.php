<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();


    }
    //Creaation utilisateur
    // Insertion utilisateur
    public function create($data)
    {
        $test=true;
        if($this->findByUserRole($data)==null){
            $this->user=new User(
                [
                    'name'=>$data['username'],
					'email'=>$data['email'],
                    'password'=>Hash::make($data['password']),
                    'activated'=>true,
                ]
            );

            Role::find($data['roleuser'])->users()->save($this->user);
            $test=false;
        }
        return $test;
    }
    //Recherche utilisateur en fonction de son nom et role
    public function findByUserRole($data)
    {
        return  $this->user
            ->where('name',$data['username'])
            ->where('role_id',$data['roleuser'])
            ->first();

    }
    public function getAll()
    {
        return $this->user->get();
    }
    public function getPaginate($n)
    {
        return $this->user->paginate($n);
    }
    //Obtenir un utilisateur en fonction de son identifiant
    public function findByID($n)
    {
        return $this->user->find($n);
    }

    // Modifier info utilisateur
    public function updateUser($datas)
    {
        if($datas['password'] == ''){
            $user =  User::findOrFail($datas['id_user']);
            $user->name = $datas["username"];
            $user->email = $datas["email"];
            $user->role_id = $datas["role"];
            $user->update();
        }else{
            $user =  User::findOrFail($datas['id_user']);
            $user->name = $datas["username"];
            $user->password =Hash::make($datas['password']);
            $user->email = $datas["email"];
            $user->role_id = $datas["role"];
            $user->update();
        }
        
    }

    // Suppression utilisateur
    public function deleteUser($iduser)
    {
        $user =  User::findOrFail($iduser);   
        return $user->delete();
    }

    // Modifier profil
    public function updateProfil($data)
    {
        if($data['new_password'] == ''){
            $user =  User::findOrFail($data['id_user']);
            $user->name = $data["username_profil"];
            $user->email = $data["email_profil"];
            $user->update();
        }else{
            $user =  User::findOrFail($data['id_user']);
            $user->name = $data["username_profil"];
            $user->password =Hash::make($data['new_password']);
            $user->email = $data["email_profil"];
            $user->update();
        }
    }

}
