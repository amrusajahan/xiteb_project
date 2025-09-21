<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function registerProcess(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'address' => 'required|string|max:255',
                'dob' => 'required|date',
                'phone' => 'required|string|max:15',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'dob' => $request->dob,
            'contact_no' => $request->phone,
            // default role is 'user' per migration; allow passing role optionally
            'role' => $request->input('role', 'user'),
        ]);

        // dd($user);
        return redirect()->route('login.show')->with('success', 'Registration successful. Please login.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ]
        );

        $credentials = $request->only('email', 'password');

        if (FacadesAuth::attempt($credentials)) {

            // Redirect users to dashboards based on their role
            $user = FacadesAuth::user();

            if ($user->role === 'pharmacy') {
                return redirect()->intended(route('dashboard.pharmacy'));
            }

            // default to normal user dashboard
            return redirect()->intended(route('dashboard.user'));
        }
    }

    public function logout(Request $request)
    {
        FacadesAuth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
