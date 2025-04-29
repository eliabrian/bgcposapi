<?php

namespace App\Http\Requests\Inventory;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
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
            'sku' => 'required|string|unique:inventories',
            'name' => 'required|string',
            'quantity' => 'required|decimal:0,2',
            'unit' => 'required|string',
            'price' => 'required|decimal:0,2',
            'stock' => 'required|decimal:0,2',
        ];
    }
}
