<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class LoginController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLoginForm()
    {
        return view('login'); // Make sure your view file is named login.blade.php
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        // 1. Validate the form data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to log in as an Admin
        // We need to fetch the admin first to check the password manually,
        // as the 'password' column name might be different.
        $admin = \App\Models\Admin::where('admin_email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->admin_password)) {
            Auth::guard('admin')->login($admin);
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        // 3. Attempt to log in as a Cashier
        $cashier = \App\Models\Cashier::where('cashier_email', $credentials['email'])->first();
        if ($cashier && Hash::check($credentials['password'], $cashier->cashier_password)) {
            Auth::guard('cashier')->login($cashier);
            $request->session()->regenerate();
            return redirect()->intended('/cashier');
        }

        // 4. Attempt to log in as a Customer (default guard)
        $customer = \App\Models\Customer::where('customer_email', $credentials['email'])->first();
        if ($customer && Hash::check($credentials['password'], $customer->customer_password)) {
            Auth::guard('web')->login($customer);
            $request->session()->regenerate();
            return redirect()->intended('/customer');
        }

        // 5. If all attempts fail, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Log out from all guards to be safe
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('cashier')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
