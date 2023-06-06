<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
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
            'nombre_razon_social' => 'required|unique:proveedores|min:3',
            'nit_ci' => 'required|min_digits:8|numeric',
            'tel_cel' => 'required|min_digits:8|numeric',
        ];
    }

    /***
     * Mensajes de error perzonalizadas
     */
    public function messages(): array
    {
        return [
            'nit_ci.min_digits' => 'El campo Nit/CI al menos debe de tener :min digitos',
        ];
    }

    public function attributes(): array
    {
        return [
            'tel_cel' => 'Telefono/Cel',
        ];
    }
}
