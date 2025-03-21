<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
      'phone' => 'required|string|regex:/^\+380(\d){9}$/i|min:13|max:13',
      'email' => 'required|email:strict', // TO DO: RFC2822
      'position_id' => 'required|numeric|exists:positions,id',
      'password' => 'required|min:6|confirmed',
    ];
  }
}
