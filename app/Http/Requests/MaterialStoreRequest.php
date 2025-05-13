<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow all authenticated users to make this request
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
            'no_material' => ['required', 'string', 'unique:materials,no_material'],
            'nama_material' => ['required', 'string'],
            'jenis_material' => ['required', 'string'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
        ];
    }
}
