<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            'name' => 'required|max:255',
            'sinopse' => 'required',
            'category_id' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                  => 'O campo Nome do Livro é obrigatório.',
            'sinopse.required'                 => 'O campo Sinopse do Livro é obrigatório.',
            'category_id.required' => 'O campo Categoria do Livro é obrigatório.',
            'category_id.integer' => 'O campo Categoria do Livro deve ser um inteiro.',
        ];
    }

}
