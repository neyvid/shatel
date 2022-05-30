<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissions\Permissions;
use App\Models\Roles\Roles;
use App\Repositories\UserRepository\UserRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRolePermission extends Controller
{
    protected  $userRepository;
    public function __construct()
    {
        $this->userRepository=new UserRepository();
    }

    public function CreateRole()
    {
        Role::create(['name' => Roles::MANAGER]);
        Role::create(['name' => Roles::SUPPORTER]);
        Role::create(['name' => Roles::USER]);
    }

    public function CreatePermission()
    {
        Permission::create(['name' => Permissions::TOTALACCESS]);
        Permission::create(['name' => Permissions::SUPPORTERACCESS]);
        Permission::create(['name' => Permissions::USERACCESS]);
    }

    public function assignPermissionToRole()
    {
        Role::findByName(Roles::MANAGER)->givePermissionTo(Permissions::TOTALACCESS);
        Role::findByName(Roles::SUPPORTER)->givePermissionTo(Permissions::SUPPORTERACCESS);
        Role::findByName(Roles::USER)->givePermissionTo(Permissions::USERACCESS);
    }


    public function assingRoleToUser()
    {
        $user = $this->userRepository->find(2);
        $user->assignRole(Roles::MANAGER);
    }

    public function assignPermissionToUser()
    {
        $user = $this->userRepository->find(2);
        $user->givePermissionTo(Permissions::TOTALACCESS);
    }
}
