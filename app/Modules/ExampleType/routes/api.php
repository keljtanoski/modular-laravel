<?php

/**
 * ExampleType API Routes
 */

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->name('api.')->group(function () {

    Route::get('example-types', ['as' => 'example_types.index', 'uses' => 'Api\ExampleTypesController@index']);
    Route::post('example-types', ['as' => 'example_types.store', 'uses' => 'Api\ExampleTypesController@store']);
    Route::get('example-types/{id}', ['as' => 'example_types.show', 'uses' => 'Api\ExampleTypesController@show']);
    Route::patch('example-types/{id}', ['as' => 'example_types.update', 'uses' => 'Api\ExampleTypesController@update']);
    Route::delete('example-types/{id}', ['as' => 'example_types.destroy', 'uses' => 'Api\ExampleTypesController@destroy']);

});
