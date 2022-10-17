<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesAttachmentsControllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\Customers_Reports;
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
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoicesController::class);
Route::resource('sections', SectionsController::class);
Route::resource('products', ProductsController::class);
Route::get('/section/{id}', [App\Http\Controllers\InvoicesController::class,'getproducts']);
Route::get('/InvoicesDetails/{id}', [App\Http\Controllers\InvoicesDetailsController::class,'edit']);
Route::get('download/{invoice_number}/{file_name}', [App\Http\Controllers\InvoicesDetailsController::class,'get_file']);
Route::get('View_file/{invoice_number}/{file_name}', [App\Http\Controllers\InvoicesDetailsController::class,'open_file']);
Route::post('delete_file', [App\Http\Controllers\InvoicesDetailsController::class,'destroy'])->name('delete_file');
Route::resource('InvoiceAttachments',InvoicesAttachmentsController::class);
Route::get('/edit_invoice/{id}', [App\Http\Controllers\InvoicesController::class,'edit']);
Route::get('/Status_show/{id}', [App\Http\Controllers\InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{id}', [App\Http\Controllers\InvoicesController::class,'Status_Update'])->name('Status_Update');
Route::get('Invoice_Paid', [App\Http\Controllers\InvoicesController::class,'Invoice_Paid']);
Route::get('Invoice_UnPaid', [App\Http\Controllers\InvoicesController::class,'Invoice_UnPaid']);
Route::get('Invoice_Partial', [App\Http\Controllers\InvoicesController::class,'Invoice_Partial']);
Route::resource('Archive', InvoiceArchiveController::class);
Route::get('Print_invoice/{id}', [App\Http\Controllers\InvoicesController::class,'Print_invoice']);
Route::get('export_invoices', [App\Http\Controllers\InvoicesController::class,'export']);
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});
Route::get('invoices_report', [App\Http\Controllers\Invoices_Report::class,'index']);
Route::post('Search_invoices', [App\Http\Controllers\Invoices_Report::class,'Search_invoices']);

Route::get('customers_report', [App\Http\Controllers\Customers_Reports::class,'index'])->name("customers_report");
Route::post('Search_customers', [App\Http\Controllers\Customers_Reports::class,'Search_customers']);


Route::get('/{page}', [App\Http\Controllers\AdminController::class,'index']);

