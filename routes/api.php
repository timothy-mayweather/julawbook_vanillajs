<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Route;
use App\Http\Controllers as Co;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/branch', [Co\BranchController::class, 'index']);
Route::post('/branch', [Co\BranchController::class, 'store2']);
Route::post('/login', [AuthenticatedSessionController::class, 'store2']);
Route::post('/register', [RegisteredUserController::class, 'store2']);
Route::get('download/{val}',[Co\DocumentController::class, 'download']);
Route::get('path/{val}',[Co\DocumentController::class, 'getPath']);

Route::group(['middleware'=>['auth:sanctum']],function() {
    Route::get('/is_auth', static function (){
        return ["auth"=>true];
    });
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy2']);
    Route::apiResource('branch-customer', Co\BranchCustomerController::class);
    Route::apiResource('branch-expense-type', Co\BranchExpenseTypeController::class);
    Route::apiResource('branch-fuel-product', Co\BranchFuelProductController::class);
    Route::apiResource('branch-product', Co\BranchProductController::class);
    Route::apiResource('branch-receivable-type', Co\BranchReceivableTypeController::class);
    Route::apiResource('branch-transaction-type', Co\BranchTransactionTypeController::class);
    Route::apiResource('customer', Co\CustomerController::class);
    Route::apiResource('dashboard', Co\DashboardController::class);
    Route::apiResource('debt', Co\DebtController::class);
    Route::apiResource('dip', Co\DipController::class);
    Route::apiResource('employee', Co\EmployeeController::class);
    Route::apiResource('file', Co\DocumentController::class);
    Route::apiResource('expense', Co\ExpenseController::class);
    Route::apiResource('expense-type', Co\ExpenseTypeController::class);
    Route::apiResource('fuel-product', Co\EmployeeController::class);
    Route::apiResource('fuel-stock', Co\FuelStockController::class);
    Route::apiResource('inventory', Co\InventoryController::class);
    Route::apiResource('log', Co\LogController::class);
    Route::apiResource('meter', Co\MeterController::class);
    Route::apiResource('nozzle', Co\NozzleController::class);
    Route::apiResource('prepaid', Co\PrepaidController::class);
    Route::apiResource('product', Co\ProductController::class);
    Route::apiResource('product-sale', Co\ProductSaleController::class);
    Route::apiResource('product-type', Co\ProductTypeController::class);
    Route::apiResource('pump', Co\PumpController::class);
    Route::apiResource('receivable', Co\ReceivableController::class);
    Route::apiResource('receivable-type', Co\ReceivableTypeController::class);
    Route::apiResource('summary', Co\SummaryController::class);
    Route::apiResource('supplier', Co\SupplierController::class);
    Route::apiResource('tank', Co\TankController::class);
    Route::apiResource('tank-stock', Co\TankStockController::class);
    Route::apiResource('transaction', Co\TransactionController::class);
    Route::apiResource('transaction-type', Co\TransactionTypeController::class);
});
