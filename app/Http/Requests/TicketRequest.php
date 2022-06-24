<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'title'       => 'required|string|min:5',
            'type'        => 'required|in:type_1,type_2,type_3',
            'status'      => 'required|in:status_1,status_2,status_3',
            'priority'    => 'required|in:priority_1,priority_2,priority_3',
            'description' => 'required|string|min:5',
            'context'     => 'string|min:5',
        ];
    }
}
