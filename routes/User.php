<?php


Route::post('/test/{id}',['uses'=>'Test@index','middleware'=>'auth'])->where(['id'=>'[0-9]+']);
Route::delete('/test',['uses'=>'Test@index1']);
Route::get('/test/{token}',['uses'=>'Test@index1']);

Route::get('/phone/{uid}/{phone}',['uses'=>'Message@send'])->where(['uid'=>'[0-9]+','phone'=>'[0-9]+']);
Route::put('/phone/{uid}/{phone}',['uses'=>'Message@send']);

Route::patch('/test',['uses'=>'Test@index1','middleware'=>'auth']);
Route::put('/test',['uses'=>'Test@index1','middleware'=>'auth']);
