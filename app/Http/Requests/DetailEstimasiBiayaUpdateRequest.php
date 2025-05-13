<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailEstimasiBiayaUpdateRequest extends FormRequest
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
        $id = $this->route('detail_estimasi'); // Assuming route parameter name

        return [
            'id_detail_estimasi' => ['required', 'string', 'unique:detail_estimasi_biayas,id_detail_estimasi,' . $id . ',id_detail_estimasi'],
            'id_estimasi' => ['required', 'string'],
            'nama' => ['required', 'string'],
            'detail_type' => ['required', 'string'],
            'harga_satuan' => ['required', 'numeric', 'min:0'],
            'qty' => ['required', 'integer', 'min:1'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'keterangan' => ['nullable', 'string'],
        ];
    }
}
