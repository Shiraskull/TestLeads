<?php

use App\Livewire\Leads;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('leads');
// });
Route::get('/', Leads::class)->name('home');
