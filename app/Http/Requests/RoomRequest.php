<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ajusta esta lógica según tus necesidades de autorización
    }

    public function rules()
    {
        $rules = [
            'number' => 'required|integer|unique:rooms',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $roomId = $this->route('room')->id;
            $rules['number'] = 'required|integer|unique:rooms,number,' . $roomId;
            $rules['status'] = 'required|in:available,occupied';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'number.required' => 'El número de la habitación es obligatorio.',
            'number.integer' => 'El número de la habitación debe ser un valor entero.',
            'number.unique' => 'El número de la habitación ya está en uso.',
            'status.required' => 'El estado de la habitación es obligatorio.',
            'status.in' => 'El estado de la habitación debe ser "available" o "occupied".',
        ];
    }
}
