<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCRUDController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MapController;
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

// Route::get('/',  function(){
//     return view('welcome');
// });


Route::get('/', [LoginController::class, 'form_login'])->name('login.form_login');


Route::get('/form_login', [LoginController::class, 'form_login'])->name('login.form_login');

Route::post('/form_login', [LoginController::class, 'login'])->name('login.login');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/companies', [CompanyCRUDController::class, 'index'])->name('companies.index');


Route::get('/companies/index', [CompanyCRUDController::class, 'index'])->name('companies.index');


// Route::get('/companies/index', [CompanyCRUDController::class, 'index'])->name('companies.index')->middleware('auth');

Route::middleware(['auth'])->group(function () {    


    Route::get('/companies/edit/{company}', [CompanyCRUDController::class, 'edit'])->name('companies.edit');


    Route::delete('/companies/{company}', [CompanyCRUDController::class, 'destroy'])->name('companies.destroy');

    Route::post('/companies', [CompanyCRUDController::class, 'store'])->name('companies.store');

    Route::put('/companies/{company}', [CompanyCRUDController::class, 'update'])->name('companies.update');


    Route::get('/map/index', [MapController::class, 'index'])->name('map.index');

   

   Route::get('/companies/pages11', [CompanyCRUDController::class, 'pages11'])->name('companies.pages11');

    Route::get('/companies/create', [CompanyCRUDController::class, 'create'])->name('companies.create');

   Route::get('/chef/main', [ChefController::class, 'main'])->name('chef.main');

    
    Route::get('/shop/main', [ShopController::class, 'main'])->name('shop.main');

    Route::post('/map/save', [MapController::class, 'save'])->name('map.save');

    Route::get('/map/show', [MapController::class, 'show'])->name('map.show');

   

});










