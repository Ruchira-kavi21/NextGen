<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required|in:customer,seller',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Check email uniqueness for the appropriate table
        if ($validatedData['role'] === 'customer') {
            $request->validate([
                'email' => 'unique:customers,email',
            ]);
        } else {
            $request->validate([
                'email' => 'unique:sellers,email',
            ]);
        }

        $userData = [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'status' => 'active', // Default status
        ];

        if ($validatedData['role'] === 'customer') {
            $user = Customer::create($userData);
            \Auth::guard('customer')->login($user);
        } else {
            $user = Seller::create($userData);
            \Auth::guard('seller')->login($user);
        }

        return redirect()->route($validatedData['role'] === 'customer' ? 'index' : 'sellers.dashboard')
            ->with('success', 'Account created successfully!');
    }
}