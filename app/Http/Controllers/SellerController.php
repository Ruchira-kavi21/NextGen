<?php

namespace App\Http\Controllers;

use App\Models\SecondHandPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerController extends Controller
{
    public function dashboard(Request $request)
    {
        $seller = Auth::guard('seller')->user();
        \Log::info('SellerController dashboard', [
            'seller' => $seller ? $seller->toArray() : null,
        ]);

        $parts = SecondHandPart::where('seller_id', $seller->id)->get();
        return view('sellers.dashboard', compact('seller', 'parts'));
    }

    public function showSellForm()
    {
        return view('sellers.sell');
    }

    public function sell(Request $request)
    {
        $seller = Auth::guard('seller')->user();
        if (!$seller) {
            return redirect('/login')->with('error', 'Please log in to sell a part.');
        }

        $validated = $request->validate([
            'part_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,Available,Sold',
            'condition' => 'required|in:New,Used',
            'category' => 'nullable|in:GPU,CPU,Motherboard,RAM,Storage,PSU',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $part = new SecondHandPart();
        $part->part_name = $validated['part_name']; // Changed from 'name' to 'part_name'
        $part->description = $validated['description'];
        $part->price = $validated['price'];
        $part->status = $validated['status'];
        $part->condition = $validated['condition'];
        $part->category = $validated['category'];
        $part->seller_id = $seller->id;
        $part->listing_date = now();

        // Handle image uploads
        if ($request->hasFile('image1')) {
            $part->image1 = $request->file('image1')->store('parts', 'public');
        }
        if ($request->hasFile('image2')) {
            $part->image2 = $request->file('image2')->store('parts', 'public');
        }
        if ($request->hasFile('image3')) {
            $part->image3 = $request->file('image3')->store('parts', 'public');
        }

        $part->save();

        return redirect()->route('sellers.dashboard')->with('success', 'Part submitted for approval successfully.');
    }
    public function editPart($id)
    {
        $seller = Auth::guard('seller')->user();
        $part = SecondHandPart::where('id', $id)->where('seller_id', $seller->id)->firstOrFail();
        return view('sellers.edit', compact('part'));
    }

    public function updatePart(Request $request, $id)
    {
        $seller = Auth::guard('seller')->user();
        $part = SecondHandPart::where('id', $id)->where('seller_id', $seller->id)->firstOrFail();

        $validated = $request->validate([
            'part_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,Available,Sold',
            'condition' => 'required|in:New,Used',
            'category' => 'nullable|in:GPU,CPU,Motherboard,RAM,Storage,PSU',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $part->part_name = $validated['part_name']; // Changed from 'name' to 'part_name'
        $part->description = $validated['description'];
        $part->price = $validated['price'];
        $part->status = $validated['status'];
        $part->condition = $validated['condition'];
        $part->category = $validated['category'];

        // Handle image uploads (delete old images if new ones are uploaded)
        if ($request->hasFile('image1')) {
            if ($part->image1) {
                Storage::disk('public')->delete($part->image1);
            }
            $part->image1 = $request->file('image1')->store('parts', 'public');
        }
        if ($request->hasFile('image2')) {
            if ($part->image2) {
                Storage::disk('public')->delete($part->image2);
            }
            $part->image2 = $request->file('image2')->store('parts', 'public');
        }
        if ($request->hasFile('image3')) {
            if ($part->image3) {
                Storage::disk('public')->delete($part->image3);
            }
            $part->image3 = $request->file('image3')->store('parts', 'public');
        }

        $part->save();

        return redirect()->route('sellers.dashboard')->with('success', 'Part updated successfully.');
    }

    public function deletePart($id)
    {
        $seller = Auth::guard('seller')->user();
        $part = SecondHandPart::where('id', $id)->where('seller_id', $seller->id)->firstOrFail();

        // Delete associated images
        if ($part->image1) {
            Storage::disk('public')->delete($part->image1);
        }
        if ($part->image2) {
            Storage::disk('public')->delete($part->image2);
        }
        if ($part->image3) {
            Storage::disk('public')->delete($part->image3);
        }

        $part->delete();

        return redirect()->route('sellers.dashboard')->with('success', 'Part deleted successfully.');
    }
    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}