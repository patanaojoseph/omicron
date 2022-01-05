<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\Category;
use App\Models\User;
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

Route::get('/about', [AboutController::class, 'about'])->name('abt');
Route::get('/contact', [ContactController::class, 'contact'])->name('con');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $user = User::all();
    return view('dashboard',compact('user'));
})->name('dashboard');


Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('add.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'EditCat'])->name('edit.category');
Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCat'])->name('update.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'DelCat'])->name('delete.category');
Route::get('/category/restore/{id}', [CategoryController::class, 'RestoreCat'])->name('restore.category');
Route::get('/category/remove/{id}', [CategoryController::class, 'RemoveCat'])->name('remove.category');


Route::get('/brand/all', [CategoryController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [CategoryController::class, 'AddBrand'])->name('add.brand');
Route::get('/brand/edit/{id}', [CategoryController::class, 'EditBrand'])->name('edit.brand');
Route::post('/brand/update/{id}', [CategoryController::class, 'UpdateBrand'])->name('update.brand');
Route::get('/brand/delete/{id}', [CategoryController::class, 'DeleteBrand'])->name('delete.brand');


