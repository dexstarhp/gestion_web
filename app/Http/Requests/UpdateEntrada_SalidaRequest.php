<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntrada_SalidaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fecha' => 'required|date',
            'total' => 'required|numeric',
            'item_id.*' => 'required|exists:items,id',
            'precio_unitario.*' => 'required|numeric',
            'cantidad.*' => 'required|numeric',
        ];
    }
}
