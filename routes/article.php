<?php

Route::get('/paragraph/{id}',['uses'=>'Article@paragraph','middleware'=>'auth'])->where(['id'=>'[0-9]+']);