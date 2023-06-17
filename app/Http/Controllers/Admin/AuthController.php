<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\AjaxResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use AjaxResponse;

    public function index()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request){

        $credentials=$request->only(['username','password']);
        $auth=User::where('username',$credentials['username'])->first();
        if(!$auth || !Hash::check($credentials['password'], $auth->password)){
            return $this->errorResponse('Username atau passwrod tidak valid',401);
        }
        Auth::login($auth);
        return $this->successResponse($auth);
    }
}
