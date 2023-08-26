<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\LoginController;
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
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Rutas para gestionar usuarios
    });

 // Ruta para la selección de rol
    Route::get('/selectRole', [UserController::class, 'selectRole'])->name('selectRole');
    Route::post('/selectRole', [UserController::class, 'setActiveRole'])->name('set.active.role');
Route::post('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
// Ruta para mostrar la vista de inicio de sesión
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

// Ruta para manejar el proceso de inicio de sesión
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['role:Ventas'])->group(function () {
    Route::get('/home/vendedor', function () {
        return view('vendedor_home');
    })->name('vendedor.home');
});
Route::middleware(['auth', 'role.access:Administrador'])->group(function () {
    Route::get('/home/admin', function () {
        return view('admin_home');
    })->name('admin.home');


    Route::resource('users', UserController::class);
    // Rutas para la gestión de usuarios
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Rutas para gestionar roles
    Route::resource('roles', RoleController::class);
    
// Rutas para la gestión de roles
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
});

