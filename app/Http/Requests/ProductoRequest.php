<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:100|unique:productos,nombre',
            'precio' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:500',
            'categoria_id' => 'required|exists:categorias,id'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.unique' => 'Ya existe un producto con ese nombre.',
            'precio.min' => 'El precio debe ser mayor a cero.',
            'categoria_id.required' => 'Debe seleccionar una categoría.'
        ];
    }

}