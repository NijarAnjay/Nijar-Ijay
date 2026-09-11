<?php

namespace App\Http\Requests\Jenis;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('jenis', 'nama')->ignore($this->route('jenis')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama jenis wajib diisi.',
            'nama.unique' => 'Nama jenis sudah digunakan.',
        ];
    }
}
