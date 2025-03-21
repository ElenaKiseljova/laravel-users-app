<?php

use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
})->name('main');

// Users
Route::get('/users', function (Request $request) {
  $users = User::with('position')->paginate(6);

  if ($request->ajax()) {
    return Blade::render('<x-user-items :users="$users" />', ['users' => $users]);
  }
  return view('users.index', compact('users'));
})->name('users.index');

// Positions
Route::get('/positions', function () {
  $positions = Position::withCount('users')->get();

  return view('positions.index', compact('positions'));
})->name('positions.index');
