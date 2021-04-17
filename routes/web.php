<?php

use App\Http\Controllers\ParentController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupCompositionController;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::get('/athletes', [AthleteController::class, 'index'])->name('athletes');
    Route::get('/athletes/create', [AthleteController::class, 'create'])->name('athletes.createathlete');
    Route::get('/athletes/orderbygroup/{order?}', [AthleteController::class, 'orderByGroup'])->name('athletes.orderbygroup');
    Route::get('/athletes/{id}', [AthleteController::class, 'show'])->name('athlete.show');
    Route::post('/athletes', [AthleteController::class, 'store']);
    Route::get('/athletes/{id}/edit', [AthleteController::class, 'edit'])->name('athletes.editathletes');
    Route::patch('/athletes/{id}', [AthleteController::class, 'update'])->name('athletes.update');
    Route::delete('/athletes/{id}', [AthleteController::class, 'destroy']);
    Route::get('/athletes/{id}/payments', [AthleteController::class, 'payments'])->name('athletes.payments');
    Route::post('/athletes/search', [AthleteController::class, 'search'])->name('athletes.search');
    Route::get('/athletes/{id}/fiscal_cert', [AthleteController::class, 'fiscalCertification'])->name('athletes.fiscal_cert');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::patch('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.delete');
    Route::post('/payments/search', [PaymentController::class, 'search']);
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
    Route::get('payments/{id}/duplicate', [PaymentController::class, 'duplicate'])->name('payments.duplicate');

    Route::get('/groups', [GroupController::class, 'index'])->name('groups');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.creategroup');
    Route::post('/groups', [GroupController::class, 'store']);
    Route::get('/groups/{id}/edit', [GroupController::class, 'edit'])->name('groups.editgroups')->where('id', '[0-9]+');
    Route::patch('/groups/{id}', [GroupController::class, 'update'])->name('groups.update')->where('id', '[0-9]+');;
    Route::delete('/groups/{id}', [GroupController::class, 'destroy'])->name('groups.delete')->where('id', '[0-9]+');
    Route::get('/groups/{id}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/groups/{id}/payments', [GroupController::class, 'payments'])->name('groups.payments');
    Route::get('/groups/{id}/paymentsPDF', [GroupController::class, 'paymentsPDF'])->name('groups.paymentsPDF');
    Route::get('/groups/{id}/pdf', [GroupController::class, 'pdf'])->name('groups.pdf');
    Route::get('/groups/{id}/payments_xls', [GroupController::class, 'payments_group_excels'])->name('groups.paymemnts_export_xls');

    Route::get('/groups/{id}/composition', [GroupCompositionController::class, 'index'])->name('groups.composition.components');
    Route::get('/groups/{id}/composition/add', [GroupCompositionController::class, 'create'])->name('groups.composition.add');
    Route::post('/groups/{id}/composition', [GroupCompositionController::class, 'add'])->name('groups.composition');
    Route::delete('/groups/component/{id}', [GroupCompositionController::class, 'destroy']);

    Route::get('/parents', [ParentController::class, 'index']);

    Route::get('/settings', [SettingController::class, 'edit']);
    Route::patch('/settings', [SettingController::class, 'update'])->name('settings.update');
});

//Route::get('/athletes', [AthleteController::class, 'index'])->middleware('auth');
/*Route::get('/athletes', function() {
    return Athlete::all();
});*/
