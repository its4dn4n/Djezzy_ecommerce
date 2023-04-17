<?php

namespace App\Http\Requests\products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['nullable','unique:products','min:3','max:20'],
            'image'=> ['nullable','image'],
            'quantity'=> ['nullable','number'],
            'price'=> ['nullable','number'],
            'description'=>['nullable','min:20','max:500'],
        ];
    }
}
