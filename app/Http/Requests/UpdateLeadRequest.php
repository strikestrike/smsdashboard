<?php

namespace App\Http\Requests;

use App\Models\Lead;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLeadRequest extends FormRequest
{
    // public function authorize()
    // {
    //    return Gate::allows('lead_edit');
    // }

    public function rules()
    {
        return [
            'email' => [
                'string',
                'required',
                'unique:leads,email,' . request()->route('lead')->id,
            ],
        ];
    }
}
