<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientesRequest extends FormRequest
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
        $id_cliente = $this->route('cliente.id');
        return [
            'nombre' => 'required|unique:clientes,nombre,'.$id_cliente.'|min:3',
            'ci' => 'required|unique:clientes,ci,'.$id_cliente.'|min_digits:8|numeric',

        ];
    }
}
