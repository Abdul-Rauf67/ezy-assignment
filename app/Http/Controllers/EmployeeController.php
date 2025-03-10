<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\PartnerEmployee;
use DB;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view employee', ['only' => ['index']]);
        $this->middleware('permission:create employee', ['only' => ['create','store']]);
        $this->middleware('permission:update employee', ['only' => ['update','edit']]);
        $this->middleware('permission:delete employee', ['only' => ['destroy']]);
    }

    public function index()
    {
        $loggedInUserId = Auth::id();

        if ($loggedInUserId == 1) {
           $employees = Employee::with(['user', 'parent', 'user.roles'])
           ->where('admin_role_id', 2)
           ->whereHas('parent', function ($query) {
               $query->whereNotNull('id');
           })
           ->get();
        } else {
            // Super Admin: Retrieve all employees where admin_role_id is 2 and parent_id exists
            $employees = Employee::with(['user', 'parent', 'user.roles'])
            ->where('admin_role_id', 2)
            ->where('parent_id', $loggedInUserId)
            ->whereHas('parent', function ($query) {
                $query->whereNotNull('id');
            })
            ->get();

        }

        return view('role-permission.admin-employee.index', ['employees' => $employees]);
    }

    public function create()
    {
        // Fetch users who have the role ID 2 (admins)
        $admins = User::whereHas('roles', function($query) {
            $query->where('id', 2); // Role ID for 'admin'
        })->pluck('name', 'id')->all();

        return view('role-permission.admin-employee.create', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:20',
            're_password' => 'required|same:password',
        ]);

        // Directly set the role ID to 6 for employees
        $employeeRoleId = 6;

        $admin = DB::table('admins')->where('user_id',$request->admin)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $employeeRoleId,
        ]);

        // If the role ID is for an employee (6), create an entry in the admin_employees table
        if ($user->role_id == 6) {
            $adminRoleId = 2; // Set the admin role ID
            Employee::create([
                'user_id' => $user->id,
                'admin_role_id' => $adminRoleId,
                'parent_id' => $request->admin,
                'name' => $request->name,
            ]);
        }

        return redirect('/admin-employees')->with('status', 'Employee Added Successfully');

    }

    public function destroy($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);
        $employee->user()->delete(); // This will delete the user as well
        $employee->delete();
        return redirect('/admin-employees')->with('status', 'Employee Deleted Successfully');
    }

    public function edit(Employee $adminEmployee)
    {
        $admins = User::role(2)->pluck('name', 'id')->all();
        $selectedPartner = $adminEmployee->parent;

        return view('role-permission.admin-employee.edit', compact('adminEmployee', 'admins', 'selectedPartner'));
    }


    public function update(Request $request, PartnerEmployee $adminEmployee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $adminEmployee->user_id,
            'password' => 'nullable|string|min:6|max:20',
            'dealer_id'=>'required|max:10|unique:admin_employees,dealer_id,' . $adminEmployee->id,
        ]);

        $user = $adminEmployee->user;

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $adminEmployee->name = $request->name;
        $adminEmployee->dealer_id = $request->dealer_id;
        // Update parent_id
        $adminEmployee->parent_id = $request->filled('admin') ? $request->admin : Auth::id();
        $adminEmployee->admin_role_id = 2;

        $adminEmployee->save();

        return redirect('/admin-employees')->with('status', 'Employee Updated Successfully');
    }

}
