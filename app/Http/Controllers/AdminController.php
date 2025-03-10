<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use App\Models\Provider;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use App\Models\Employee;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function test()
    {
        return view('test');
    }

    public function index()
    {
        $admins = Admin::with('user.roles')->get();
        return view('role-permission.admin.index', compact('admins'));
    }

    public function create()
    {
        return view('role-permission.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:20',
            're_password' => 'required|same:password',
        ]);

        // Directly set the role ID to 2
        $roleId = 2;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleId,
        ]);


        // Check if the role is 'admin' (role ID 2)
        if ($roleId == 2) {
            Admin::create([
                'user_id' => $user->id,
                'name' => $request->name,
            ]);
        }

        $user->syncRoles([$roleId]);

        return redirect('/admins')->with('status', 'Admin Added Successfully');

    }

    public function edit(Admin $admin)
    {
        return view('role-permission.admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->user_id,
            'password' => 'nullable|string|min:6|max:20',
        ]);

        $user = $admin->user;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $admin->name = $request->name;
        $admin->save();

        return redirect('/admins')->with('status', 'Admin Updated Successfully');
    }


    public function destroy($adminId)
    {
        $admin = Admin::findOrFail($adminId);
        $admin->user()->delete();
        $admin->delete();
        return redirect('/admins')->with('status', 'Admin Deleted Successfully');
    }
}
