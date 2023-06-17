<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/admin/auth');
    }
}
