<?php

use App\Admin\Controllers\AuthController;
use App\Admin\Controllers\FieldsController;
use App\Admin\Controllers\ModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

/** ADMIN **/

Route::any('/admin', function () {
    if (Auth::user()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});
Route::any('/admin/login', [AuthController::class, 'login'])->name('login');
Route::any('/admin/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard.index', ['user' => Auth::user()]);
    })->name('dashboard');

    /* models */

    Route::get('/admin/model/list/{modelName}', function (Request $request, $modelName) {
        $params = $request->all();
        unset($params['q']);
        return view('admin.model.list', [
            'user' => Auth::user(),
            'modelName' => $modelName,
            'params' => $params
        ]);
    })->name('model.list');

    Route::any('/admin/model/create/{modelName}', [ModelController::class, 'create'])->name('model.create');
    Route::any('/admin/model/edit/{modelName}/{modelId}', [ModelController::class, 'edit'])->name('model.edit');
    Route::any('/admin/model/delete/{modelName}/{modelId}', [ModelController::class, 'delete'])->name('model.delete');
    Route::any('/admin/model/upload/{modelName}/{modelId}', [ModelController::class, 'upload'])->name('model.upload');

    /* fields */

    Route::get('/admin/fields/list/{fieldName}', function ($fieldName) {
        return view('admin.fields.list', [
            'user' => Auth::user(),
            'fieldName' => $fieldName
        ]);
    })->name('fields.list');

    Route::any('/admin/fields/edit/{fieldName}/{modelId?}', [FieldsController::class, 'edit'])->name('field.edit');
    Route::any('/admin/fields/delete/{fieldName}/{modelId}', [FieldsController::class, 'delete'])->name('field.delete');
});

/** FRONTEND **/

Route::get('/', function () {
    return view('frontend.index.index');
});

/* drafts */

Route::get('/drafts/services', function () {
    return view('frontend.drafts.services');
});
Route::get('/drafts/products', function () {
    return view('frontend.drafts.products');
});
