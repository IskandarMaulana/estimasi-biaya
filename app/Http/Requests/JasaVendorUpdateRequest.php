<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JasaVendorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('jasa_vendor'); // Assuming route parameter name

        return [
            'id_jasa' => ['required', 'string', 'unique:jasavendors,id_jasa,' . $id . ',id_jasa'],
            'jasa' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
        ];
    }
}
