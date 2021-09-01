<?php

/**
 * ExampleType WEB Routes
 */

use Illuminate\Support\Facades\Route;

Route::get('example-types', 'ExampleTypesController@index')->name('example_types.index');
Route::get('example-types/create', 'ExampleTypesController@create')->name('example_types.create');
Route::post('example-types', 'ExampleTypesController@store')->name('example_types.store');
Route::get('example-types/{id}', 'ExampleTypesController@show')->name('example_types.show');
Route::get('example-types/{id}/edit', 'ExampleTypesController@edit')->name('example_types.edit');
Route::patch('example-types/{id}', 'ExampleTypesController@update')->name('example_types.update');
Route::delete('example-types/{id}', 'ExampleTypesController@destroy')->name('example_types.destroy');
