<?php

namespace App\Http\Controllers;

use App\Models\SecondHandPart;
use App\Models\Seller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $totalParts = SecondHandPart::count();
        $totalSellers = Seller::count();
        $totalCustomers = Customer::count();
        $totalSales = SecondHandPart::where('status', 'approved')->sum('price');

        $sellers = Seller::all();
        $customers = Customer::all();
        $parts = SecondHandPart::with('seller')->where('status', 'Available')->get();
        $pendingParts = SecondHandPart::with('seller')->where('status', 'pending')->get();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $parts = SecondHandPart::whereBetween('created_at', [$startDate, $endDate])->with('seller')->get();
            $totalSales = SecondHandPart::where('status', 'Available')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('price');
        }

        return view('Admin.dashboard', compact(
            'totalParts',
            'totalSellers',
            'totalCustomers',
            'totalSales',
            'sellers',
            'customers',
            'parts',
            'pendingParts',
            'startDate',
            'endDate'
        ));
    }

    public function exportSalesReport(Request $request)
    {
        $approvedPartsQuery = SecondHandPart::where('status', 'approved');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $approvedPartsQuery->whereBetween('updated_at', [$startDate, $endDate]);
        }

        $approvedParts = $approvedPartsQuery->get();

        $csvData = [];
        $csvData[] = ['Part Name', 'Description', 'Price', 'Seller', 'Approved At'];

        foreach ($approvedParts as $part) {
            $csvData[] = [
                $part->name,
                $part->description,
                number_format($part->price, 2),
                $part->seller ? $part->seller->first_name . ' ' . $part->seller->last_name : 'N/A',
                $part->updated_at,
            ];
        }

        $filename = 'sales_report_' . now()->format('Ymd_His') . '.csv';
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Write data to CSV
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
        exit;
    }

    public function approvePart($id)
{
    $part = SecondHandPart::findOrFail($id);
    $part->status = 'Available';
    $part->save();

    return redirect()->route('admin.dashboard')->with('success', 'Part approved successfully.');
}

public function declinePart($id)
{
    $part = SecondHandPart::findOrFail($id);
    $part->status = 'declined';
    $part->save();

    return redirect()->route('admin.dashboard')->with('success', 'Part declined successfully.');
}

    // Add Seller
    public function addSeller(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email',
            'password' => 'required|string|min:6',
        ]);

        $seller = new Seller();
        $seller->first_name = $request->input('first_name');
        $seller->last_name = $request->input('last_name');
        $seller->email = $request->input('email');
        $seller->password = bcrypt($request->input('password'));
        $seller->save();

        return redirect()->route('admin.dashboard')->with('success', 'Seller added successfully.');
    }

    // Edit Seller
    public function editSeller(Request $request, $id)
    {
        $seller = Seller::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:sellers,email,' . $seller->id,
            'password' => 'nullable|string|min:6',
        ]);

        $seller->first_name = $request->input('first_name');
        $seller->last_name = $request->input('last_name');
        $seller->email = $request->input('email');
        if ($request->filled('password')) {
            $seller->password = bcrypt($request->input('password'));
        }
        $seller->save();

        return redirect()->route('admin.dashboard')->with('success', 'Seller updated successfully.');
    }

    public function deleteSeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Seller deleted successfully.');
    }

    // Add Customer
    public function addCustomer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6',
        ]);

        $customer = new Customer();
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        $customer->password = bcrypt($request->input('password'));
        $customer->save();

        return redirect()->route('admin.dashboard')->with('success', 'Customer added successfully.');
    }

    // Edit Customer
    public function editCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'password' => 'nullable|string|min:6',
        ]);

        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        if ($request->filled('password')) {
            $customer->password = bcrypt($request->input('password'));
        }
        $customer->save();

        return redirect()->route('admin.dashboard')->with('success', 'Customer updated successfully.');
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Customer deleted successfully.');
    }

    // Add SecondHandPart (Component)
    public function addPart(Request $request)
    {
        $request->validate([
            'part_name' => 'required|string|max:255',
            'seller' => 'required|exists:sellers,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Sold',
            'condition' => 'nullable|in:New,Used',
            'category' => 'nullable|in:GPU,CPU,Motherboard,RAM,Storage,PSU',
            'description' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'part_name' => $request->input('part_name'),
            'seller_id' => $request->input('seller'),
            'price' => $request->input('price'),
            'status' => 'approved',
            'condition' => $request->input('condition'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'listing_date' => now(),
        ];

        // Handle image uploads
        if ($request->hasFile('image1')) {
            $data['image1'] = $request->file('image1')->store('parts', 'public');
        }
        if ($request->hasFile('image2')) {
            $data['image2'] = $request->file('image2')->store('parts', 'public');
        }
        if ($request->hasFile('image3')) {
            $data['image3'] = $request->file('image3')->store('parts', 'public');
        }

        SecondHandPart::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Part added successfully.');
    }

    public function editPart(Request $request, $id)
    {
        $part = SecondHandPart::findOrFail($id);

        $request->validate([
            'part_name' => 'required|string|max:255',
            'seller' => 'required|exists:sellers,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Sold',
            'condition' => 'nullable|in:New,Used',
            'category' => 'nullable|in:GPU,CPU,Motherboard,RAM,Storage,PSU',
            'description' => 'nullable|string',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $part->part_name = $request->input('part_name'); // Ensure this is 'part_name', not 'name'
        $part->seller_id = $request->input('seller');
        $part->price = $request->input('price');
        $part->status = $request->input('status');
        $part->condition = $request->input('condition');
        $part->category = $request->input('category');
        $part->description = $request->input('description');

        // Handle image uploads
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

        return redirect()->route('admin.dashboard')->with('success', 'Part updated successfully.');
    }
    public function deletePart($id)
    {
        $part = SecondHandPart::findOrFail($id);

        // Delete associated images from storage
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

        return redirect()->route('admin.dashboard')->with('success', 'Part deleted successfully.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_email');
        $request->session()->flush();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}