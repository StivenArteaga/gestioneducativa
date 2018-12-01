<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecretariaRequest extends FormRequest
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
            'PrimerNombreSecretaria'=>'required|string|max:50', 
            'SegundoNombreSecretaria'=> 'nullable|string',
            'PrimerApellidoSecretaria'=>'required|string|max:50',
            'SegundoApellidoSecretaria'=>'required|string|max:50',
            'IdTipoDocumento'=>'required|int',
            'NumeroDocumentoSecretaria'=>'required|string|max:50',
            'CorreoSecretaria'=>'required|string|max:100',
            'DireccionSecretaria'=>'required|string|max:200',
            'TelefonoSecretaria'=>'required|string|max:100',
            'EstadoSecretaria'=>'required',
            'IdSede'=>'required|int'
        ];
    }

    public function messages()
    {
        return [
            'PrimerNombreSecretaria.required' => 'El campo primer nombre es obligatorio.',
            'PrimerApellidoSecretaria.required' => 'El campo Primer Apellido es obligatorio.',
            'SegundoApellidoSecretaria.required' => 'El campo Segundo Apellido es obligatorio.',
            'IdTipoDocumento.max' => 'El campo Número de Documento debe tener máximo 20 caracteres.',
            'NumeroDocumentoSecretaria.unique' => 'El campo Número de Documento es obligatorio.',
            'CorreoSecretaria.required' => 'El campo Correo Electrónico es obligatorio.',
            'DireccionSecretaria.date' => 'El campo Fecha de Nacimiento debe ser una fecha valida.',
            'TelefonoSecretaria.required' => 'El campo Teléfono es obligatorio.',
            'EstadoSecretaria.email' => 'El campo Correo Electrónico debe ser un correo valido.',
            'IdSede.max' => 'El campo Dirección debe contener máximo 100 caracteres.',
            'Telefono' => ''
        ];
    }
}
