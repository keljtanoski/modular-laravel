<?php

/**
 * Example WEB Routes
 */

use Illuminate\Support\Facades\Route;

Route::get('examples', 'ExamplesController@index')->name('examples.index');
Route::get('examples/create', 'ExamplesController@create')->name('examples.create');
Route::post('examples', 'ExamplesController@store')->name('examples.store');
Route::get('examples/{id}', 'ExamplesController@show')->name('examples.show');
Route::get('examples/{id}/edit', 'ExamplesController@edit')->name('examples.edit');
Route::patch('examples/{id}', 'ExamplesController@update')->name('examples.update');
Route::delete('examples/{id}', 'ExamplesController@destroy')->name('examples.destroy');
