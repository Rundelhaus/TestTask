<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix('/users')->group(function () {
    Route::get('', 'UserController@index');
    Route::post('/', 'UserController@store');
    Route::prefix('/{user}')->group(function () {
        Route::get('/', 'UserController@showUser');
        Route::post('/', 'UserController@update');
        Route::delete('/', 'UserController@destroy');
    });
});

Route::prefix('/teachers')->group(function () {
    Route::get('', 'UserController@indexTeachers');
    Route::get('/{teacher}', 'UserController@showTeacher');
});

Route::prefix('/students')->group(function () {
    Route::get('', 'UserController@indexStudents');
    Route::get('/{student}', 'UserController@showStudent');
});

Route::prefix('/marks')->group(function () {
    Route::get('', 'MarkController@index');
    Route::post('/', 'MarkController@store');
    Route::prefix('/{mark}')->group(function () {
        Route::get('/', 'MarkController@show');
        Route::post('/', 'MarkController@update');
        Route::delete('/', 'MarkController@destroy');
    });
});

Route::prefix('/schedules')->group(function () {
    Route::get('', 'ScheduleController@index');
    Route::post('/', 'ScheduleController@store');
    Route::prefix('/{schedule}')->group(function () {
        Route::get('/', 'ScheduleController@show');
        Route::post('/', 'ScheduleController@update');
        Route::delete('/', 'ScheduleController@destroy');
    });
});

Route::prefix('/schedule-items')->group(function () {
    Route::get('', 'ScheduleItemController@index');
    Route::post('/', 'ScheduleItemController@store');
    Route::prefix('/{schedule-item}')->group(function () {
        Route::get('/', 'ScheduleItemController@show');
        Route::post('/', 'ScheduleItemController@update');
        Route::delete('/', 'ScheduleItemController@destroy');
    });
});

Route::prefix('/schools')->group(function () {
    Route::get('', 'SchoolController@index');
    Route::post('/', 'SchoolController@store');
    Route::prefix('/{school}')->group(function () {
        Route::get('/', 'SchoolController@show');
        Route::post('/', 'SchoolController@update');
        Route::delete('/', 'SchoolController@destroy');
    });
});

Route::prefix('/subjects')->group(function () {
    Route::get('', 'SubjectController@index');
    Route::post('/', 'SubjectController@store');
    Route::prefix('/{subject}')->group(function () {
        Route::get('/', 'SubjectController@show');
        Route::post('/', 'SubjectController@update');
        Route::delete('/', 'SubjectController@destroy');
    });
});
