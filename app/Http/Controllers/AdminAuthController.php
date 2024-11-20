<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AdminAuthController extends Controller
{
    protected $guard = 'web';

    public function adminLoginForm(AdminLoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::query()->where('email', $email)->firstOr(function () {
            throw ValidationException::withMessages([
                'email' => [__('auth.Email not found')]
            ]);
        });
        if (Hash('sha1', $password) !== $user->password) {
            throw ValidationException::withMessages([
                'password' => [__('Email немеме құпия сөз қате')]
            ]);
        }
        Auth::guard($this->guard)->login($user);
        return redirect()->route('admin.index');
    }
    public function profile()
    {
        $user = Auth::user();
        return Inertia::render('Admin/Profile/Edit', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash('sha1', $request->real_password),
            'real_password' => $request->real_password,
        ]);
        return redirect()->route('admin.index')->withSuccess("Сәтті сақталды!");
    }
    public function logout()
    {
        Auth::guard($this->guard)->logout();
        return redirect()->route('adminLoginShow');
    }
}
