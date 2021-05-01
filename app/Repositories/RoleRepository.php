<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use App\Models\Role;
use App\User;

class RoleRepository extends BaseRepository
{
    //
    protected $role;
    public function __construct()
    {
        $this->role = new Role();

    }
    public function getAll()
    {

        return Role::all();
    }
    public function getRole()
    {
        return $this->role->exists;
    }
    public function findIdRole($id_role)
    {
        return $this->role->find($id_role);
    }
}
