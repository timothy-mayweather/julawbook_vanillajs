<?php

use App\Http\Controllers\Route;
use App\Http\Controllers as Co;

Route::get('/', static function () {return view('welcome');})->name('welcome');
Route::resource('branch' , Co\BranchController::class)->middleware('guest');

Route::group(['middleware'=>['auth']], static function() {
    Route::get('/registerClient',[Co\ClientController::class, 'register']);
    Route::get('/main', static function () { return view('layouts.main');});
    Route::get('download/{val}',[Co\DocumentController::class, 'download']);
    Route::resource('branch-customer', Co\BranchCustomerController::class);
    Route::resource('branch-expense-type', Co\BranchExpenseTypeController::class);
    Route::resource('branch-fuel-product', Co\BranchFuelProductController::class);
    Route::resource('branch-product', Co\BranchProductController::class);
    Route::resource('branch-receivable-type', Co\BranchReceivableTypeController::class);
    Route::resource('branch-transaction-type', Co\BranchTransactionTypeController::class);
    Route::resource('customer', Co\CustomerController::class);
    Route::resource('dashboard', Co\DashboardController::class);
    Route::resource('debt', Co\DebtController::class);
    Route::resource('dip', Co\DipController::class);
    Route::resource('employee', Co\EmployeeController::class);
    Route::resource('file', Co\DocumentController::class);
    Route::resource('expense', Co\ExpenseController::class);
    Route::resource('expense-type', Co\ExpenseTypeController::class);
    Route::resource('fuel-product', Co\FuelProductController::class);
    Route::resource('fuel-stock', Co\FuelStockController::class);
    Route::resource('inventory', Co\InventoryController::class);
    Route::resource('log', Co\LogController::class);
    Route::resource('meter', Co\MeterController::class);
    Route::resource('nozzle', Co\NozzleController::class);
    Route::resource('prepaid', Co\PrepaidController::class);
    Route::resource('product', Co\ProductController::class)->middleware(['auth']);
    Route::resource('product-sale', Co\ProductSaleController::class);
    Route::resource('product-type', Co\ProductTypeController::class)->middleware(['auth']);
    Route::resource('pump', Co\PumpController::class);
    Route::resource('receivable', Co\ReceivableController::class);
    Route::resource('receivable-type', Co\ReceivableTypeController::class);
    Route::resource('summary', Co\SummaryController::class);
    Route::resource('supplier', Co\SupplierController::class);
    Route::resource('tank', Co\TankController::class);
    Route::resource('tank-stock', Co\TankStockController::class);
    Route::resource('transaction', Co\TransactionController::class);
    Route::resource('transaction-type', Co\TransactionTypeController::class);
});
require __DIR__.'/auth.php';
