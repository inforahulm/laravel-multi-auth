<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});  

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web','PreventBack'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        Route::post('/create',[UserController::class,'create'])->name('create');
        Route::post('/check',[UserController::class,'check'])->name('check');

    });

    Route::middleware(['auth:web','PreventBack'])->group(function(){
         Route::view('/home', 'dashboard.user.home')->name('home');
         Route::post('/logout',[UserController::class,'logout'])->name('logout');
    });

});

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBack'])->group(function(){
        Route::view('/login','dashboard.admin.login')->name('login');
        Route::post('/check',[AdminController::class,'check'])->name('check');

    });

    Route::middleware(['auth:admin','PreventBack'])->group(function(){
         Route::view('/home', 'dashboard.admin.home')->name('home');
         Route::post('/logout',[AdminController::class,'logout'])->name('logout');
    });

});
Route::prefix('employee')->name('employee.')->group(function(){

    Route::middleware(['guest:employee','PreventBack'])->group(function(){
        Route::view('/login','dashboard.employee.login')->name('login');
        Route::view('/register', 'dashboard.employee.register')->name('register');
        Route::post('/create',[EmployeeController::class,'create'])->name('create');
        Route::post('/check',[EmployeeController::class,'check'])->name('check');

    });

    Route::middleware(['auth:employee','PreventBack'])->group(function(){
         Route::view('/home', 'dashboard.employee.home')->name('home');
         Route::post('/logout',[EmployeeController::class,'logout'])->name('logout');
    });

});

