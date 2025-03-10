<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TaskController;



Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');               // List all tasks
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');       // Show form to create task
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');               // Store new task
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');           // Show task details
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');      // Show form to edit task
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');       // Update task
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');  // Delete task


Route::post('tasks/{task}/add-comment', [TaskController::class, 'addComment'])->name('tasks.addComment');
Route::put('tasks/{task}/comments/{comment}', [TaskController::class, 'updateComment'])->name('tasks.updateComment');
Route::delete('tasks/{task}/comments/{comment}', [TaskController::class, 'deleteComment'])->name('tasks.deleteComment');


Route::get('/', function () {
    return view('auth/login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout',  [LoginController::class,'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/fiber-sales',[App\Http\Controllers\SalesController::class,'view_fiber_sales']);

Route::get('/admin-sales',[App\Http\Controllers\SalesController::class,'view_admin_sales']);

Route::post('/update-sale-status',[App\Http\Controllers\SalesController::class,'updateSaleStatus']);

Route::match(['get', 'post'], '/view-sale-details',[App\Http\Controllers\SalesController::class,'viewSaleDetails'])->name('sales_details');
Route::get('/sales-details/{id}', [App\Http\Controllers\SalesController::class, 'showSaleDetails'])->name('sales_details');



//Route::get('task', [\App\Http\Controllers\TaskController::class, 'task']);
//Route::get('task-edit', [\App\Http\Controllers\TaskController::class, 'taskEdit']);
//


Route::group(['middleware' => ['isAdmin']], function (){

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permission}/delete', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{role}/delete', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
        // ->middleware('permission:delete role');

    Route::get('roles/{role}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{role}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy'])->name('permissions.destroy');

    Route::resource('admins', App\Http\Controllers\AdminController::class);
    Route::get('admins/{adminId}/delete', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admins.destroy');

    Route::resource('admin-employees', App\Http\Controllers\EmployeeController::class);
    Route::get('admin-employees/{employeeId}/delete', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('permissions.destroy');

});

