<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required|in:admin,customer,seller',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = [
            'email' => trim(strtolower($validatedData['email'])),
            'password' => trim($validatedData['password']),
        ];

        $role = $validatedData['role'];

        \Log::info('Login attempt', [
            'role' => $role,
            'email' => $credentials['email'],
            'password' => $credentials['password'], 
        ]);

        // Check if the user exists
        $model = match ($role) {
            'admin' => \App\Models\Admin::class,
            'customer' => \App\Models\Customer::class,
            'seller' => \App\Models\Seller::class,
        };

        $user = $model::where('email', $credentials['email'])->first();

        if (!$user) {
            \Log::info('User not found', ['role' => $role, 'email' => $credentials['email']]);
            return back()->withErrors(['email' => 'No user found with this email address for the selected role.']);
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            \Log::info('Password mismatch', ['role' => $role, 'email' => $credentials['email']]);
            return back()->withErrors(['password' => 'The provided password is incorrect.']);
        }

        $guard = Auth::guard($role);
        if ($guard->attempt($credentials)) {
            \Log::info('Login successful', ['role' => $role]);
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'customer') {
                return redirect()->route('index');
            } elseif ($role === 'seller') {
                return redirect()->route('sellers.dashboard');
            }
        }

        \Log::info('Login failed', ['role' => $role]);
        return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
    }
//     public function login(Request $request)
// {
//     $validatedData = $request->validate([
//         'role' => 'required|in:admin,customer,seller',
//         'email' => 'required|email',
//         'password' => 'required|string|min:6',
//     ]);

//     $credentials = [
//         'email' => trim(strtolower($validatedData['email'])),
//         'password' => trim($validatedData['password']),
//     ];

//     $role = $validatedData['role'];

//     // Log the attempted login
//     \Log::info('Login attempt', [
//         'role' => $role,
//         'email' => $credentials['email'],
//     ]);

//     // Determine the model based on the role
//     $model = match ($role) {
//         'admin' => \App\Models\Admin::class,
//         'customer' => \App\Models\Customer::class,
//         'seller' => \App\Models\Seller::class,
//     };

//     // Retrieve the user from the database
//     $user = $model::where('email', $credentials['email'])->first();

//     if (!$user) {
//         \Log::info('User not found', ['role' => $role, 'email' => $credentials['email']]);
//         return back()->withErrors(['email' => 'No user found with this email address for the selected role.']);
//     }

//     if (!Hash::check($credentials['password'], $user->password)) {
//         \Log::info('Password mismatch', ['role' => $role, 'email' => $credentials['email']]);
//         return back()->withErrors(['password' => 'The provided password is incorrect.']);
//     }

//     // Attempt to authenticate the user using the appropriate guard
//     $guard = Auth::guard($role);  // Make sure to use the correct guard here for admin, customer, or seller

//     if ($guard->attempt($credentials)) {
//         \Log::info('Login successful', ['role' => $role]);

//         // Redirect based on role
//         if ($role === 'admin') {
//             return redirect()->route('admin.dashboard');
//         } elseif ($role === 'customer') {
//             return redirect()->route('index');
//         } elseif ($role === 'seller') {
//             return redirect()->route('sellers.dashboard');
//         }
//     }

//     \Log::info('Login failed', ['role' => $role]);
//     return back()->withErrors(['email' => 'The provided credentials are incorrect.']);
// }


    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
        } elseif (Auth::guard('seller')->check()) {
            Auth::guard('seller')->logout();
        }

        return redirect('/login');
    }
}