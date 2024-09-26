<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\ForgetEmailPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function registration(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
        try {
            $createUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role_id' => $request->role_id ?? 2
            ]);

            if ($createUser) {
                toastr()->success('user registerd successfully!');
                return redirect('/');
            }
        } catch (\Exception $e) {
            info('Getting exception error in auth registration function' . $e->getMessage());
        }
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        } catch (\Exception $e) {
            info('Getting exception error in auth login function' . $e->getMessage());
        }
    }

    public function forgetPassword()
    {
        return view('auth.forget_password', ["id" => '', 'token' => '']);
    }

    public function sendUpdatePasswordEmail(Request $request)
    {
        $userDetail = User::where('email', $request->email)->first();
        $emailOneTimeToken = Str::random(20);
        //send email if user exist 
        if ($userDetail) {
            $userDetail->email_token = $emailOneTimeToken;
            $userDetail->save();
            $data = [
                'id' => $userDetail->id,
                'name' => $userDetail->name,
                'token' => $emailOneTimeToken,
            ];
            Mail::to($userDetail->email)->send(new ForgetEmailPassword($data));
            toastr()->success('Please check your email password reset email has been send.');
            return back();
        }
        toastr()->error('Email is not exist in the database.');
        return back();
    }

    public function emailForgetPasswordLink($id, $token)
    {
        $isTokenValid = User::where('email_token', $token)->exists();
        if ($isTokenValid) {
            return view('auth.forget_password', ["id" => $id, 'token' => $token]);
        }
        return view('errors.token_invalid');
    }

    public function updatePassword(Request $request, $id, $token)
    {
        $decryptId = Crypt::decrypt($id);
        $user = User::find($decryptId);
        try {
            if ($user && $user->email_token == $token) {
                $user->update([
                    'password' => $request->password,
                    'email_token' => null
                ]);
                toastr()->success('password updated successfully');
                return redirect('/');
            }
            toastr()->error('User is not exist in our database');
            return back();
        } catch (\Exception $e) {
            info('Getting exception error in auth update password function' . $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
