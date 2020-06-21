<?php

namespace App\Model\Properties\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'suburb' => ['required'],
            'state' => ['required'],
            'country' => ['required']
        ];
    }
}
