<?php   
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = DB::table('park_admins')
            ->where('email', $request->input('email'))
            ->where('status', 'active')
            ->first();

        if ($admin && $admin->password === $request->input('password')) {
            $request->session()->put('admin_id', $admin->admin_id);
            $request->session()->put('admin_name', $admin->name);

            return redirect('/admin/dashboard');
        }

        return redirect('/admin/login')->withErrors(['Invalid credentials']);
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 

        return redirect('/admin/login');
    }
}
