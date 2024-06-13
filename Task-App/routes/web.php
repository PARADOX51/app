<?php
 
use App\Models\Tasks;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TasksController;


Route::get('/', function () {
    return view('home');
})->name('home');
 
Route::get('/tasks', [UserController::class, 'tasks'])->name('tasks');
 
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
 
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
 
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
 
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [UserController::class, 'userprofile'])->name('profile');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');
 
    Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');
 
    Route::get('/admin/tasks', [TasksController::class, 'index'])->name('admin/tasks/index');
    Route::get('/admin/tasks/create', [TasksController::class, 'create'])->name('admin/tasks/create');
    Route::post('/admin/tasks', [TasksController::class, 'store'])->name('admin/tasks/store');
    Route::get('/admin/tasks/{task}', [TasksController::class, 'show'])->name('admin/tasks/show');
    Route::get('/admin/tasks/{task}/edit', [TasksController::class, 'edit'])->name('admin/tasks/edit');
    Route::put('/admin/tasks/{task}', [TasksController::class, 'update'])->name('admin/tasks/update');
    Route::delete('/admin/tasks/{task}', [TasksController::class, 'destroy'])->name('admin/tasks/destroy');
    Route::put('/admin/tasks/{task}/complete', [TasksController::class, 'complete'])->name('admin/tasks/complete');
});