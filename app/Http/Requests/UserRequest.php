<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => 'required|min:2|max:60',
      'photo' => [
        'image',
        Rule::requiredIf(
          !$this->user_id,
        ),
        File::types(['jpg', 'jpeg'])
          ->max(5 * 1024),
        Rule::dimensions()
          ->minWidth(70)
          ->minHeight(70)
        // ->ratio(1 / 1)
      ],
      'phone' => 'required|string|regex:/^\+380(\d){9}$/i|min:13|max:13',
      'email' => 'required|email:strict|max:255|unique:users,email,' . $this->user_id, // TO DO: RFC2822
      'position_id' => 'required|numeric|exists:positions,id',
      'password'  => [
        Rule::requiredIf(
          !$this->user_id,
        ),
        Rule::excludeIf($this->method() !== 'POST' && empty($this->password)),
        'min:8',
        'confirmed'
      ]
    ];
  }

  public function messages()
  {
    return [
      'photo.dimensions' => 'The photo resolution must be at least 70x70 pixels and have an aspect ratio of 1/1.',
    ];
  }

  public function getData()
  {
    $data = $this->validated();

    // Files
    $directory = User::makeDirectory();;

    // Photo
    if ($this->hasFile('photo')) {
      // TO DO: optimize and crop image before save
      $data['photo'] = $this->file('photo')->store($directory);
    }

    // Password
    if (!empty($data['password'])) {
      $data['password'] = Hash::make($data['password']);
    }

    // TO DO: send email

    return $data;
  }
}
