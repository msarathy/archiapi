<?php

namespace App\Model\PropertyAnalytics\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyAnalyticsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_id' => [ 'required' ],
            'value' => [ 'required' ]
        ];
    }
}
