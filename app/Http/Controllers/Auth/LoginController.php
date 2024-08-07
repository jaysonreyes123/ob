<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }
    public function process(Request $request)
    {
        $credetial = [
            "email" => $request->email,
            "password" => $request->password
        ];
        if(Auth::attempt($credetial)){
            if(Auth::user()->role == 4){
                return redirect()->route('index',["access_token"=>User::ACCESS_TOKEN]);
            }
            else{
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return Redirect()->route('login');
            }
        }
        else{
            return redirect()->back()->with(['error-message' => 'Invalid credential']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect()->route('login');
    }
}
