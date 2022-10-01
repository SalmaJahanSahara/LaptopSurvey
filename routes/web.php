<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|hg
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return '<h1>Laptop Survey</h1>';
// });

Route:: get('/', [BaseController::class, 'basic'])->name('basic');
Route:: post('/basic-submit', [BaseController::class, 'basicSubmit'])->name('basic.submit');

Route:: get('/index', [BaseController::class, 'index'])->name('index');



Route:: get('/laptops', [BaseController::class, 'laptops'])->name('laptops');
Route:: post('/laptops', [BaseController::class, 'laptopsSubmit'])->name('laptops.submit');

Route:: get('/insert-laptop', [BaseController::class, 'insert'])->name('insert');
Route:: post('/insert-laptop', [BaseController::class, 'insertSubmit'])->name('insert.submit');

Route:: get('/filter-laptop', [BaseController::class, 'filter'])->name('filter');
Route:: post('/filter-laptop', [BaseController::class, 'filterSubmit'])->name('filter.submit');


