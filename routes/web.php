<?php
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


/**
 * List tasks
 */
Route::get('/', 'TaskController@index')->name('index');

/**
 * Form for add new task
 */
Route::get('/add', 'TaskController@create')->name('create');

/**
 * Add new task
 */
Route::post('/task', 'TaskController@store')->name('store');

/**
 * Render form for edit single task
 */
Route::get('/edit/{id}', 'TaskController@edit')->name('edit');

/**
 * Edit task
 */
Route::post('/edit/{id}', 'TaskController@update')->name('update');

/**
 * Delete task
 */
Route::delete('/task/{id}', 'TaskController@destroy')->name('destroy');