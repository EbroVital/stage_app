<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAvisRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'objet' => 'required|string|max:255',
            'montant' => 'required|numeric',
            'beneficiaire' => 'required|string|max:255',
            'entendu' => 'nullable|string',
            'heure_debut' => 'nullable|date_format:H:i',
            'heure_fin' => 'nullable|date_format:H:i',
        ];
    }
}
