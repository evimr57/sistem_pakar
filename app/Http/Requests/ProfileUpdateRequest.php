<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9_]+$/', Rule::unique(User::class)->ignore($this->user()->id)],
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'no_hp' => ['required', 'string', 'max:15', 'regex:/^(\+62|62|0)[0-9]{9,13}$/'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.regex' => 'Username hanya boleh huruf, angka, dan underscore',
            'username.unique' => 'Username sudah digunakan',
            'no_hp.regex' => 'Format nomor HP tidak valid. Contoh: 08123456789',
        ];
    }
}