<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'daily_rate' => 'required|integer|min:2|max:100',
            'model' => 'required|string|min:5|max:255',
            'category_id' => 'required|exists:categories,id',
            'make_id' => 'required|exists:makes,id'
        ];
    }
}
