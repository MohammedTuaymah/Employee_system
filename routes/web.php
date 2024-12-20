<?php

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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    

//Auth::routes();
Auth::routes(['register' => false]);

Route::group(['middleware'=>['auth','has.permission']],function(){

    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::resource('departments','DepartmentController');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('permissions','PermissionController');
    Route::resource('leaves','LeaveController');
    Route::post('accept-reject-leave/{id}','LeaveController@acceptReject')->name('accept.reject');
    Route::resource('notices','NoticeController');

    Route::get('/mail','MailController@create')->name('mails.create');
    Route::post('/mail','MailController@store')->name('mails.store');
});


