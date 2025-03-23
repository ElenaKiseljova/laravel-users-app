<?php

use App\Http\Requests\CreateUserRequest;
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

Route::get('/users/create', function () {
  $user = new User();

  $positions = Position::get();

  return view('users.create', compact('user', 'positions'));
})->name('users.create');

Route::post('/users/store', function (CreateUserRequest $request) {
  dd($request);

  return to_route('users.index')->with('message', 'User has been created successfully');
})->name('users.store');

Route::get('/users/{user}/edit', function (User $user) {
  $positions = Position::get();

  return view('users.edit', compact('user', 'positions'));
})->name('users.edit');

Route::put('/users/{user}', function (Request $request) {
  dd($request);

  return back()->with('message', 'User has been updated successfully');
})->name('users.update');

Route::delete('/users/{user}', function (User $user) {
  $user->delete();

  return back()->with('message', 'User has been removed successfully');
})->name('users.destroy');

Route::get('/users/{user}', function (User $user) {
  return view('users.show', compact('user'));
})->name('users.show');


// Positions
Route::get('/positions', function () {
  $positions = Position::withCount('users')->get();

  return view('positions.index', compact('positions'));
})->name('positions.index');
