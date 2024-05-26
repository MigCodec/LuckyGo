<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
        'numbers' => 'required|array|size:5',
        'numbers.*' => 'integer|between:1,30',
        'im_feeling_lucky' => 'sometimes|boolean',
    ];
}


/**
 * Validates that only 5 numbers have been selected ion the ticket.
 * 
 *
*public function messages()
*{
*    return [
*        'numbers.size' => 'Deben selecionar exactamente 5 números.',
*    ];
*}
*/
}