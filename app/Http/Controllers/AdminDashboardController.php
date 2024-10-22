<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/admin/login')->withErrors(['Please log in to access the dashboard.']);
        }

        $totalUsers = DB::table('park_users')->count();
        $activeUsers = DB::table('park_users')->where('status', 'active')->count();
        $inactiveUsers = DB::table('park_users')->where('status', 'inactive')->count();
        $usersRegisteredToday = DB::table('park_users')->whereDate('created_at', today())->count();

        $totalSpaces = DB::table('park_spaces')->count();
        $availableSpaces = DB::table('park_spaces')->where('status', 'available')->count();
        $occupiedSpaces = DB::table('park_spaces')->where('status', 'occupied')->count();
        $spacesReservedToday = DB::table('park_spaces')->whereDate('created_at', today())->count();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
            'usersRegisteredToday' => $usersRegisteredToday,
            'totalSpaces' => $totalSpaces,
            'availableSpaces' => $availableSpaces,
            'occupiedSpaces' => $occupiedSpaces,
            'spacesReservedToday' => $spacesReservedToday,
        ]);
    }
}
