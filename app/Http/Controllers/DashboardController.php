<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Roles $roles)
    {
        $usersList = User::where('role_id', '!=', 1)
            ->where('id', '!=', Auth::user()->id)
            ->get();
        return view('dashboard.users.index', ['usersList' => $usersList]);
    }

    public function edit($id){
        $userDetail = $this->getUserById($id);
        $roles = Roles::get();
        return view('dashboard.users.edit', ['userDetail' => $userDetail, 'roles' => $roles]);
    }

    public function update($id){
        $userDetail = $this->getUserById($id);
        $roles = Roles::get();
        return view('dashboard.index', ['userDetail' => $userDetail, 'roles' => $roles]);
    }

    public function getUserById($id){
        return User::find($id);
    }
}
