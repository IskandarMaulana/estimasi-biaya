<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartUpdateRequest extends FormRequest
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
        $id = $this->route('part'); // Assuming route parameter name

        return [
            'id_part' => ['required', 'string', 'unique:parts,id_part,' . $id . ',id_part'],
            'nama_part' => ['required', 'string'],
            'tipe_mobil' => ['required', 'string'],
            'no_part' => ['required', 'string'],
            'no_part_eff' => ['required', 'string'],
            'no_part_carb' => ['required', 'string'],
            'harga_part_eff' => ['required', 'numeric', 'min:0'],
            'harga_part_carb' => ['required', 'numeric', 'min:0'],
            'stock_plan' => ['required', 'integer', 'min:0'],
            'stock_actual' => ['required', 'integer', 'min:0'],
            'selisih' => ['required', 'integer'],
        ];
    }
}
