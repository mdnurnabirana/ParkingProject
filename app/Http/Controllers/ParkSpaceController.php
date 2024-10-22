<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkSpace;

class ParkSpaceController extends Controller
{
    public function index(Request $request)
    {
        $parks = ParkSpace::where('status', 'active')->get();

        return view('park_spaces.view_park', compact('parks'));
    }

    public function manageSpaces(Request $request)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/admin/login')->withErrors(['Please log in to access this page.']);
        }

        $parkSpaces = ParkSpace::all();

        return view('admin.managespaces', [
            'parkSpaces' => $parkSpaces,
            'adminName' => session('adminName')
        ]);
    }

    public function updateSpace(Request $request, $id)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/admin/login')->withErrors(['Please log in to access this page.']);
        }

        $request->validate([
            'park_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'park_rent' => 'required|numeric',
            'payment_method' => 'required|string',
            'total_spaces' => 'required|integer',
            'available_spaces' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        $parkSpace = ParkSpace::findOrFail($id);
        $parkSpace->update($request->all());

        return redirect()->route('admin.managespaces')->with('success', 'Parking space updated successfully.');
    }

    public function deleteSpace(Request $request, $id)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/admin/login')->withErrors(['Please log in to access this page.']);
        }

        $parkSpace = ParkSpace::findOrFail($id);
        $parkSpace->delete();

        return redirect()->route('admin.managespaces')->with('success', 'Parking space deleted successfully.');
    }
}
