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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/agora-chat', 'App\Http\Controllers\AgoraVideoController@index')->name('agora-chat');
    Route::post('/agora/token', 'App\Http\Controllers\AgoraVideoController@token');
    Route::post('/agora/call-user', 'App\Http\Controllers\AgoraVideoController@callUser');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => ['auth', 'role:student']], function () {
    Route::get('/student/dashboard', 'App\Http\Controllers\student\DashboardController@index')->name('student-dashboard');

    //student details
    Route::get('/student/details', 'App\Http\Controllers\student\DashboardController@details')->name('student-details');
    Route::post('/student/details/add', 'App\Http\Controllers\student\DashboardController@add')->name('student-add-details');

    //student placement
    Route::get('/student/placement', 'App\Http\Controllers\student\PlacementController@index')->name('student-placement');
    Route::get('/student/add/placement', 'App\Http\Controllers\student\PlacementController@details')->name('student-placement-details');
    Route::post('/student/placement/add', 'App\Http\Controllers\student\PlacementController@add')->name('student-add-placement');

    //student tasks
    Route::get('/student/tasks', 'App\Http\Controllers\student\TaskController@index')->name('student-tasks');
    Route::post('/student/task/update', 'App\Http\Controllers\student\TaskController@update')->name('student-update-task');

    //student tasks
    Route::get('/student/logbook', 'App\Http\Controllers\student\LogbookController@index')->name('student-logbook');
    Route::get('/student/insert/log-book', 'App\Http\Controllers\student\LogbookController@book')->name('student-book');
    Route::post('/student/add/log-book', 'App\Http\Controllers\student\LogbookController@add')->name('student-add-book');

    //student chats
    Route::get('/student/chats', 'App\Http\Controllers\student\ChatController@index')->name('student-chats');
    Route::get('/student/chat/{id}', 'App\Http\Controllers\student\ChatController@single')->name('student-chat');
    Route::post('/student/chat/send', 'App\Http\Controllers\student\ChatController@send')->name('student-send-chat');
    Route::post('/student/chat/new', 'App\Http\Controllers\student\ChatController@new')->name('student-new-chat');

});

Route::group(['middleware' => ['auth', 'role:supervisor']], function () {
    Route::get('/supervisor/dashboard', 'App\Http\Controllers\supervisor\DashboardController@index')->name('supervisor-dashboard');

    //supervisor details
    Route::get('/supervisor/details', 'App\Http\Controllers\supervisor\DashboardController@details')->name('supervisor-details');
    Route::post('/supervisor/details/add', 'App\Http\Controllers\supervisor\DashboardController@add')->name('supervisor-add-details');

    //supervisor task
    Route::get('/supervisor/tasks', 'App\Http\Controllers\supervisor\TaskController@index')->name('supervisor-tasks');
    Route::get('/supervisor/tasks/{id}', 'App\Http\Controllers\supervisor\TaskController@user_task')->name('supervisor-usertasks');
    Route::post('/supervisor/add/task', 'App\Http\Controllers\supervisor\TaskController@add')->name('supervisor-add-tasks');
    Route::get('/supervisor/approve/{id}', 'App\Http\Controllers\supervisor\TaskController@approve')->name('supervisor-approve-task');

    //supervisor chats
    Route::get('/supervisor/chats', 'App\Http\Controllers\supervisor\ChatController@index')->name('supervisor-chats');
    Route::get('/supervisor/chat/{id}', 'App\Http\Controllers\supervisor\ChatController@single')->name('supervisor-chat');
    Route::post('/supervisor/chat/send', 'App\Http\Controllers\supervisor\ChatController@send')->name('supervisor-send-chat');
    Route::post('/supervisor/chat/new', 'App\Http\Controllers\supervisor\ChatController@new')->name('supervisor-new-chat');

    Route::get('/supervisor/log-book/{id}', 'App\Http\Controllers\supervisor\LogbookController@index')->name('supervisor-logbook');
});
