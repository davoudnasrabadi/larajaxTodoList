<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ItemController;
//main route
Route::get('/',[ItemController::class,'index'])->name('home');
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::get('/login',[LoginController::class,'index'])->name('login');

//post route for register
Route::post('/register',[RegisterController::class,'store']);

//post route for logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

//login post route 
Route::post('/login',[LoginController::class,'store']);

//items post route
Route::post('/item',[ItemController::class,'store'])->name('item');

//itemsdelete route
Route::delete('/item/{id}',[ItemController::class,'destroy']);