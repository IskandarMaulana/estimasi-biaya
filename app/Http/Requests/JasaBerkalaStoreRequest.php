<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JasaBerkalaStoreRequest extends FormRequest
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
        return [
            'id_jasa' => ['required', 'string', 'unique:jasaberkalas,id_jasa'],
            'tipe_mobil' => ['required', 'string'],
            'jenis_service' => ['required', 'string'],
            'biaya_jasa' => ['required', 'numeric', 'min:0'],
        ];
    }
}
