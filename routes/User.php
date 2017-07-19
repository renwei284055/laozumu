<?php


Route::post('/test/{id}',['uses'=>'Test@index','middleware'=>'auth'])->where(['id'=>'[0-9]+']);
Route::delete('/test',['uses'=>'Test@index1']);
Route::get('/test/{token}',['uses'=>'Test@index1']);
Route::patch('/test',['uses'=>'Test@index1','middleware'=>'auth']);
Route::put('/test',['uses'=>'Test@index1','middleware'=>'auth']);
