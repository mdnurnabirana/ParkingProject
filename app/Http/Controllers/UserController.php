<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkUser;

class UserController extends Controller
{
    private function checkAdminSession(Request $request)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/admin/login')->withErrors(['Please log in to access the dashboard.']);
        }
        return null; 
    }

    public function manageUsers(Request $request)
    {
        if ($response = $this->checkAdminSession($request)) {
            return $response;
        }

        $status = $request->query('status');

        $users = ParkUser::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->get();

        return view('admin.manageuser', [
            'users' => $users,
            'adminName' => session('adminName') 
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        if ($response = $this->checkAdminSession($request)) {
            return $response;
        }

        $request->validate([
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $user = ParkUser::findOrFail($id);
        $user->status = $request->input('status');
        $user->save();

        return redirect()->route('admin.manageuser')->with('success', 'User status updated successfully.');
    }
}
