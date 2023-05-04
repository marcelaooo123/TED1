<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class LoanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'copy_id' => 'required|exists:copies,id',
            'user_date' => 'required|date_format:Y-m-d',
        ];
    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O valor informado para o campo :attribute já está em uso.',
            'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
            'min' => [
                'numeric' => 'O campo :attribute deve ter pelo menos :min.',
                'file' => 'O arquivo :attribute deve ter pelo menos :min kilobytes.',
                'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
                'array' => 'O campo :attribute deve ter pelo menos :min itens.',
            ],
            'max' => [
                'numeric' => 'O campo :attribute não pode ser maior que :max.',
                'file' => 'O arquivo :attribute não pode ter mais que :max kilobytes.',
                'string' => 'O campo :attribute não pode ter mais que :max caracteres.',
                'array' => 'O campo :attribute não pode ter mais que :max itens.',
            ],
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'string' => 'O campo :attribute deve ser uma string.',
            'confirmed' => 'O campo :attribute de confirmação não coincide.',
            'alpha' => 'O campo :attribute deve conter apenas letras.',
            'alpha_num' => 'O campo :attribute deve conter apenas letras e números.',
            'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
            'url' => 'O campo :attribute deve ser uma URL válida.',
            'numeric' => 'O campo :attribute deve ser um número.',
            'date_format' => 'O campo :attribute deve estar no formato :format.',
            'array' => 'O campo :attribute deve ser um array.',
            'file' => 'O campo :attribute deve ser um arquivo.',
            'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
            'image' => 'O campo :attribute deve ser uma imagem.',
            'between' => [
                'numeric' => 'O campo :attribute deve estar entre :min e :max.',
                'file' => 'O arquivo :attribute deve ter entre :min e :max kilobytes.',
                'string' => 'O campo :attribute deve ter entre :min e :max caracteres.',
                'array' => 'O campo :attribute deve ter entre :min e :max itens.',
            ],
            'in' => 'O valor selecionado para o campo :attribute é inválido.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                $validator->getMessageBag()->all(),
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
