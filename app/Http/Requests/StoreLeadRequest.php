<?php

namespace App\Http\Requests;

use App\Models\Lead;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLeadRequest extends FormRequest
{
    // public function authorize()
    // {
    //    return Gate::allows('lead_create');
    // }

    public function rules()
    {
        return [
            'email' => [
                'string',
                'required',
                'unique:leads',
            ],
        ];
    }
}
