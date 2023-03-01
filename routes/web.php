<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class,'index'])->name('index');

Route::get('/product' , [ProductController::class,'index'])->name('product');

Route::get('/addproduct' , [ProductController::class,'addproduct'])->name('addproduct');

Route::post('/submit/form-data' , [ProductController::class,'store'])->name('sub_data');

Route::get('/delete-data', [ProductController::class,'DeleteData'])->name('deletedata');

Route::get('/edit-data/{id}', [ProductController::class,'EditData'])->name('editdata');

Route::get('delete/image/{id}', [ProductController::class,'delimg'])->name('delimg');

Route::post('/export_choice/submit', [ExportController::class,'store'])->name('ex_sub');

Route::get('/download/pdf', [ExportController::class,'dowpdf'])->name('dowpdf');

Route::get('push_notification', [NotificationController::class, 'index']);
Route::post('sendNotification', [NotificationController::class, 'sendNotification'])->name('send_notification');