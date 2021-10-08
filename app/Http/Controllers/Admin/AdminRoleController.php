<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminRoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();
        return view('admin.role_management.roles')->with('roles',$roles);
    }

}
