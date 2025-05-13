<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstimasiBiayaStoreRequest extends FormRequest
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
            'id_estimasi' => ['required', 'string', 'unique:estimasibiayas,id_estimasi'],
            'nama' => ['required', 'string'],
            'no_polis' => ['required', 'string'],
            'tipe_mobil' => ['required', 'string'],
            'km_aktual' => ['required', 'integer', 'min:0'],
            'tanggal_transaksi' => ['required', 'date'],
            'total_jasa' => ['required', 'numeric', 'min:0'],
            'total_barang' => ['required', 'numeric', 'min:0'],
            'total_biaya' => ['required', 'numeric', 'min:0'],
            'id_user' => ['required', 'string'],
        ];
    }
}
