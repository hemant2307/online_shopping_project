<?php

use App\Http\Controllers\admin\adminController;
use Illuminate\Support\Facades\Route;

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


Route::get('admin/login',[adminController::class , 'login'])->name('admin.login');
Route::get('admin/authentication',[adminController::class , 'authentication'])->name('admin.authentication');
