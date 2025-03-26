<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class CustomerController extends Controller
{
    public function profile()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.profile', compact('customer'));
    }

    public function editProfile()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.edit-profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'Zipcode' => 'nullable|string|max:10',
            'phone_number' => 'required|string|max:15',
            'optional_phone_number' => 'nullable|string|max:15',
            'email' => 'required|email|max:255|unique:customers,email,' . $customer->id,
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'required|in:active,inactive',
        ]);

        $customer->first_name = $validatedData['first_name'];
        $customer->last_name = $validatedData['last_name'];
        $customer->address = $validatedData['address'];
        $customer->Zipcode = $validatedData['Zipcode'];
        $customer->phone_number = $validatedData['phone_number'];
        $customer->optional_phone_number = $validatedData['optional_phone_number'];
        $customer->email = $validatedData['email'];
        $customer->status = $validatedData['status'];

        if (!empty($validatedData['password'])) {
            $customer->password = Hash::make($validatedData['password']);
        }

        $customer->save();

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
    }
    public function orders()
    {
        $customer = Auth::guard('customer')->user();
        $orders = Order::where('customer_id', $customer->id)
            ->with('part') 
            ->orderBy('order_date', 'desc')
            ->get();
        return view('customer.orders', compact('orders', 'customer'));
    }
}