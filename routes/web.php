<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Signup;
use App\Livewire\Saved;
use App\Livewire\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::name('login')->get('/login', Login::class);
Route::name('signup')->get('/signup', Signup::class);
Route::name('homepage')->get('/', Product::class)->middleware('auth');
Route::name('saved')->get('/saved', Saved::class)->middleware('auth');


