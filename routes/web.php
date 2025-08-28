<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Routes to different dashboards
Route::get('/notauth', function() {
    return view('notauth.index');
})->name('notauth');

Route::get('/user', function() {
    return view('user.index');
})->middleware('auth', 'role:user')->name('user');

Route::get('/admin', [AdminController::class, 'users'], function() {
    return view('admin.index');
})->middleware('auth', 'role:admin')->name('admin.index');

//Routes for admin to view, edit and delete users

//Route to view user details
Route::get('/admin/view/{id}', [AdminController::class, 'view'])->middleware('auth', 'role:admin')->name('admin.view');
//Route to edit user details
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->middleware('auth', 'role:admin')->name('admin.edit');
Route::put('/admin/edit/{id}', [AdminController::class, 'update'])->middleware('auth', 'role:admin')->name('admin.update');
//Route to delete user
Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->middleware('auth', 'role:admin')->name('admin.delete');


require __DIR__.'/auth.php';
