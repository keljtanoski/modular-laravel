<?php

/**
 * Example API Routes
 */

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->name('api.')->group(function () {

    Route::get('examples', ['as' => 'examples.index', 'uses' => 'Api\ExamplesController@index']);
    Route::post('examples', ['as' => 'examples.store', 'uses' => 'Api\ExamplesController@store']);
    Route::get('examples/{id}', ['as' => 'examples.show', 'uses' => 'Api\ExamplesController@show']);
    Route::patch('examples/{id}', ['as' => 'examples.update', 'uses' => 'Api\ExamplesController@update']);
    Route::delete('examples/{id}', ['as' => 'examples.destroy', 'uses' => 'Api\ExamplesController@destroy']);
    
});
