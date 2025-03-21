<?php

use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
})->name('main');

Route::get('/users', function () {
  $users = User::with('position')->get();

  return view('users.index', compact('users'));
})->name('users.index');

Route::get('/positions', function () {
  $positions = Position::withCount('users')->get();

  return view('positions.index', compact('positions'));
})->name('positions.index');
