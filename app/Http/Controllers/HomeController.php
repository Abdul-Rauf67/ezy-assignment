<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        // Start with a query builder instance instead of executing the query immediately
        $tasksQuery = DB::table('tasks');

        // Apply role-based filtering
        if ($user->role_id == 2 ) {

            $tasksQuery->where('tasks.created_by', $userId);
        }
        elseif ($user->role_id == 6) {

            $tasksQuery->where('tasks.assigned_to', $userId);
        }

        $tasksQuery->orderBy('id', 'desc');
        $tasks = $tasksQuery->paginate(5);


        return view('tasks.index', compact('tasks'));
    }
}
