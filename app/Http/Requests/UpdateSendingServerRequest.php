<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSendingServerRequest extends FormRequest
{
    // public function authorize()
    // {
    //    return Gate::allows('lead_edit');
    // }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:sending_servers,name,' . request()->route('sendingserver')->id,
            ],
        ];
    }
}
