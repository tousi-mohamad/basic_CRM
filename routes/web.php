<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

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
Route::get('/test', function () {


      $user = \App\Models\User::find(13);
      dd($user->organization->name);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//Route::get('/admin', function () {
//    return view('superAdmin.main');
//})->middleware(['auth'])->name('admin.index');

//Route::resource('/admin/roles',RoleController::class);
Route::resource('products', \App\Http\Controllers\ProductController::class)->middleware(['auth']);


require __DIR__.'/auth.php';
