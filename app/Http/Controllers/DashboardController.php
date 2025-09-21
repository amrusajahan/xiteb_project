<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login.show')->with('error', 'You must be logged in to access the dashboard.');
        }

        $user = Auth::user();

        // Return role-specific dashboard view
        if ($user->role === 'pharmacy') {
            return view('dashboard.pharmacy', ['user' => $user]);
        }

        return view('dashboard.user', ['user' => $user]);
    }
}
