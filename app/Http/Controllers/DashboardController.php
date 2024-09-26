<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    public function index(Roles $roles)
    {
        $usersList = User::where('role_id', '!=', 1)
            ->where('id', '!=', Auth::user()->id)
            ->get();
        $roles = Roles::get();
        return view('dashboard.users.index', ['usersList' => $usersList, 'roles' => $roles]);
    }

    public function edit($id)
    {
        $id = $this->decryptId($id);
        $userDetail = User::find($id);
        if ($userDetail) {
            $roles = Roles::where('id', '!=', 1)->get();
            return view('dashboard.users.edit', ['userDetail' => $userDetail, 'roles' => $roles]);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'role_id' => 'required'
        ]);
        try {
            $user = User::findOrFail($id);
            if ($user) {
                $user->update([
                    'email' => $validatedData['email'],
                    'role_id' => $validatedData['role_id'],
                    'name' => $request->name
                ]);
                toastr()->success('user updated successfully!');
                return redirect('/dashboard');
            }
            toastr()->error('user not found');
            return redirect('/dashboard');
        } catch (\Exception $e) {
            info('Getting exception updte function in dashboard' . $e->getMessage());
        }
    }

    public function userProfile()
    {
        $userDetail = User::find(Auth::user()->id);
        if ($userDetail) {
            return view('dashboard.users.profile', ['userDetail' => $userDetail]);
        }
    }

    public function deleteUser($id)
    {
        if (Auth::user()->role_id == 1) {
            $isUserExist = User::find($id);
            if ($isUserExist) {
                $isUserExist->delete();
                toastr()->success("User Deleted successfully");
                return back();
            }
            toastr()->error("User not found in our database");
            return back();
        }
        toastr()->error("You don't have permission to this action");
        return back();
    }

    public function decryptId($id)
    {
        return Crypt::decrypt($id);
    }
}
