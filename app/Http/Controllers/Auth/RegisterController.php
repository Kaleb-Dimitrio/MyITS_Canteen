<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('daftar'); // Your 'daftar.blade.php' file
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        // 1. Validate the incoming form data
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customer,customer_email'],
            'telepon' => ['required', 'string', 'min:10', 'max:15'],
            'password' => ['required', 'string', 'min:8'], // You can add a password confirmation rule later
        ]);

        // 2. Create the new customer in the database
        $customer = Customer::create([
            'customer_nama' => $validatedData['nama'],
            'customer_email' => $validatedData['email'],
            'customer_no_telp' => $validatedData['telepon'],
            'customer_password' => Hash::make($validatedData['password']), // Always hash passwords
        ]);

        // 3. Log the new customer in automatically
        Auth::guard('customer')->login($customer);

        // 4. Redirect them to their home page
        return redirect('/customer'); // Or wherever you want new customers to go
    }
}