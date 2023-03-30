<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresenceController;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::get('/register', [LoginController::class, 'add_user']);
Route::post('/register', [LoginController::class, 'create']);

Route::middleware(['auth'])
->group(function() {
    Route::get('/home',[LoginController::class, 'home'])        ;
    Route::post('/in',[PresenceController::class, 'presence_in']);
    Route::post('/out',[PresenceController::class, 'presence_out']);
    Route::get('/presence',[PresenceController::class, 'presence']);
    Route::get('/profile',[LoginController::class, 'profile']);
    Route::post('/profile',[LoginController::class, 'edit_profile']);
    Route::get('/logout',[LoginController::class, 'logout']);
});

Route::prefix('admin')
->group(function() {
        Route::get('/dashboard', [LoginController::class, 'admin']);
        Route::get('/users', [LoginController::class, 'list_user']);
        Route::get('/users/presence/{UserID}', [PresenceController::class, 'list_user_presence']);
        Route::get('/position', [PositionController::class, 'index']);
        Route::get('/position/add_position', [PositionController::class, 'add_position']);
        Route::post('/position/add_position', [PositionController::class, 'create']);
        Route::get('/position/edit_position/{PosID}', [PositionController::class, 'form_edit_position']);
        Route::post('/position/edit_position', [PositionController::class, 'edit_position']);
    });