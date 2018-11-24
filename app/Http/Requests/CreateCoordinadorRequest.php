<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCoordinadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'PrimerNombre' => 'required|string',
            'SegundoNombre' => 'nullable',
            'PrimerApellido' => 'required',
            'SegundoApellido' => 'nullable',
            'NumeroDocumento' => 'required|max:20|unique:tipodocumentos',
            'FechaNacimiento' => 'required|date',
            'Correo' => 'required|email|string|max:100',
            'Direccion' => 'nullable|string|max:100',
            'Telefono' => 'required|max:20'
        ];
        
    }

    public function messages()
    {
        return [
            'PrimerNombre.required' => 'El campo primer nombre es obligatorio.',
            'PrimerApellido.required' => 'El campo Primer Apellido es obligatorio.',
            'NumeroDocumento.required' => 'El campo Número de Documento es obligatorio.',
            'NumeroDocumento.max' => 'El campo Número de Documento debe tener máximo 20 caracteres.',
            'NumeroDocumento.unique' => 'El Número de Documento ingresado ya se encuentra registrado.',
            'FechaNacimiento.required' => 'El campo Fecha de Nacimiento es obligatorio.',
            'FechaNacimiento.date' => 'El campo Fecha de Nacimiento debe ser una fecha valida.',
            'Correo.required' => 'El campo Correo Electrónico es obligatorio.',
            'Correo.email' => 'El campo Correo Electrónico debe ser un correo valido.',
            'Direccion.max' => 'El campo Dirección debe contener máximo 100 caracteres.',
            'Telefono' => 'El campo Teléfono es obligatorio.'
        ];
    }
}
