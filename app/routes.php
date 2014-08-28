<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', function() {
    return View::make('home');
});

Route::group(array('prefix' => 'api'), function() {
    Route::get('closestpoint/{latitude}/{longitude}', array('uses' => 'PointController@closest'));
});

Route::get('/excel', function() {
    Excel::create('Filename', function($excel) {
        $excel->sheet('Sheetname', function($sheet) {
            $points = Point::get(array('primary_city'))->take(4);
            $sheet->fromArray($points);
        });
    })->export('xls');
});
