<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;

class ShuffleCardRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'totalPlayerNumber' => [
                'required',
                'numeric',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value < 0) {
                        $fail('Input value does not exist or value is invalid');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'totalPlayerNumber.required' => 'Input value does not exist or value is invalid',
            'totalPlayerNumber.numeric' => 'Input value does not exist or value is invalid',
        ];
    }
}
