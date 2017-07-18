<?php

Route::get('/paragraph/{id}',['uses'=>'Article@paragraph','middleware'=>'auth'])->where(['id'=>'[0-9]+']);
Route::get('/catalog/{id}',['uses'=>'Article@catalog'])->where(['id'=>'[0-9]+']);