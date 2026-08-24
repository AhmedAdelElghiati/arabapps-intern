<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store(LoginRequest $request)
    {
        if (Auth::guard('admin')->attempt($request->validated())) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }
    public  function destroy()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
