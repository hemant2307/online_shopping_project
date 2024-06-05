<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\homeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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




Route::group(['prefix' => 'admin'],function(){

    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('login',[adminController::class , 'login'])->name('admin.login');
        Route::POST('authentication',[adminController::class , 'authentication'])->name('admin.authentication');
        
    });
    
    
    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('dashboard',[homeController::class , 'dashboard'])->name('admin.dashboard');
        Route::get('logout',[homeController::class , 'logout'])->name('admin.logout');
        Route::get('create-category',[categoryController::class , 'create'])->name('category.create');
        Route::POST('store-category',[categoryController::class , 'store'])->name('category.store');
        Route::get('list-category',[categoryController::class , 'show'])->name('category.list');



        // route for slug

        Route::get('/getslug',function(Request $request){
            $slug = '';
            if(!empty($request->title)){
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getslug');


        
    });


});
