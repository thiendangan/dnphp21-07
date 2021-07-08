<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd("hello");
    return 'Hello World';
}); 


