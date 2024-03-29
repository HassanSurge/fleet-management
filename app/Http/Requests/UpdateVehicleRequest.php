<?php

namespace App\Http\Requests;

use App\Rules\TwoWordText;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'daily_rate' => 'required|decimal:0,2|min:2|max:100',
            'model' => ['required', 'string', 'min:5', 'max:255', new TwoWordText()],
            'category_id' => 'required|exists:categories,id',
            'make_id' => 'required|exists:makes,id'
        ];
    }
}
