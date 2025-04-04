<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // implements MustVerifyEmail
{
  /** @use HasFactory<\Database\Factories\UserFactory> */
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'photo',
    'position_id',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function position()
  {
    return $this->belongsTo(Position::class)->withDefault();
  }

  public static function makeDirectory()
  {
    $directory = 'users';

    Storage::makeDirectory($directory);

    return $directory;
  }

  public static function updatePhotoUrl(User &$user)
  {
    if ($user->photo) {
      if (Storage::exists($user->photo)) {
        $user->photo = Storage::url($user->photo);
      }
    } else {
      $user->photo = Storage::url('/users/user-default.jpg');
    }
  }
}
