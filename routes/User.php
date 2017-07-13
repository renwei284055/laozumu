<?php

use Illuminate\Http\Request;



Route::post('/test/{id}',['uses'=>'Test@index1','middleware'=>'auth'])->where(['id'=>'[0-9]+']);
Route::delete('/test',['uses'=>'Test@index1']);
Route::patch('/test',['uses'=>'Test@index1','middleware'=>'auth']);
Route::put('/test',['uses'=>'Test@index1','middleware'=>'auth']);
