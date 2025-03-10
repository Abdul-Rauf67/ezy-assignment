<?php

namespace App\Http\Controllers;

use http\Client\Response;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Comment;


class TaskController extends Controller
{
    public function task(){
        return view('tasks.create');
    }
    public function taskEdit(){
        return view('tasks.edit');
    }

    // Display a list of tasks
    public function index()
    {
//        $tasks = Task::orderBy('id', 'desc')->paginate(5);  // Paginate tasks, 5 per page

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

    // Show the form for creating a new task
    public function create()
    {
        $users = User::where('role_id', 6)->get();  // Fetch only managers/admins
        return view('tasks.create', compact('users'));
    }

    // Store a newly created task in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'task_name' => 'required|string|max:255',
            'task_description' => 'nullable|string',
            'task_start_date' => 'required|date',
            'task_end_date' => 'required|date|after_or_equal:task_start_date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validatedData['created_by'] = Auth::id();

        Task::create($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function show($id)
    {
        $task = Task::with(['comments.user'])->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    // Store a newly created comment
    public function addComment(Request $request, $taskId)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            'task_id' => $taskId,
            'user_id' => Auth::id(),
            'comment' => $validatedData['comment'],
        ]);

        return \response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'user_name' => $comment->user->name,
                'comment' => $comment->comment,
                'created_at' => $comment->created_at->format('d-m-Y H:i'),
            ],
        ]);
    }

    public function updateComment(Request $request, $taskId, $commentId)
    {
        $validatedData = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::where('task_id', $taskId)->where('id', $commentId)->firstOrFail();

        if ($comment->user_id !== Auth::id()) {
            return \response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $comment->update(['comment' => $validatedData['comment']]);

        return \response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'comment' => $comment->comment,
            ],
        ]);
    }

    public function deleteComment($taskId, $commentId)
    {
        $comment = Comment::where('task_id', $taskId)->where('id', $commentId)->firstOrFail();

        if ($comment->user_id !== Auth::id()) {
            return \response()->json(['success' => false, 'message' => 'Unauthorized action.'], 403);
        }

        $comment->delete();

        return \response()->json([
            'success' => true,
            'comment_id' => $commentId,
        ]);
    }


    // Show the form for editing the specified task
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $users = User::where('role_id', 6)->get();
        return view('tasks.edit', compact('task', 'users'));
    }

    // Update the specified task in the database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'task_name' => 'required|string|max:255',
            'task_description' => 'nullable|string',
            'task_start_date' => 'required|date',
            'task_end_date' => 'required|date|after_or_equal:task_start_date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validatedData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // Remove the specified task from the database
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}


