<?php

use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\EmailPreviewController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

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


Route::get('/send-test-email', function () {
    $order = \App\Models\Order::first(); // Recupera un ordine di esempio
    Mail::to('test@example.com')->send(new \App\Mail\CustomerOrderShipped($order));
    return 'Email di test inviata!';
});




Route::get('/', function () {
    return view('welcome');
});

Route::get('/faq', function (){
    return view('faq');
})->name('faq');

Route::middleware(['auth', 'verified'])
->name('admin.') // il prefisso che viene aggiunto a tutti i NOMI delle rotte nel gruppo
->prefix('admin') // il prefisso che viene aggiunto a tutti gli URL delle rotte nel gruppo
->group(function() {


    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Registrare tutte le altre rotte protette. Nel nostro caso aggiungeremo la CRUD sui POSTS
    
    Route::resource('companies', CompanyController::class);
    Route::resource('dishes', DishController::class);
    Route::get('dishes/showOne/{dish:company_id}', [DishController::class, 'showOne'])->name('dishes.showOne');
    Route::resource('orders', OrderController::class);
    Route::get('/orders/company/{company_id}', [OrderController::class, 'showOne'])->name('orders.showOne');
    Route::post('/orders/fetchMore/{company_id}', [OrderController::class, 'fetchMore'])->name('orders.fetchMore');
    Route::resource('types', TypeController::class);
    Route::delete('/companies/{company}/forceDelete', [CompanyController::class,'forceDestroy'])->name('companies.forceDestroy');
    Route::patch('/companies/{company}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
    Route::delete('/dishes/{dish}/forceDelete', [DishController::class,'forceDestroy'])->name('dishes.forceDestroy');
    Route::patch('/dishes/{dish}/restore', [DishController::class, 'restore'])->name('dishes.restore');
    Route::resource('statistics', StatisticsController::class);
    Route::get('bar-chart', [StatisticsController::class, 'barChartRevenueAndOrderNumber']);
    Route::get('pie-chart-revenue-order', [StatisticsController::class, 'totalRevenueTotalOrders']);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';