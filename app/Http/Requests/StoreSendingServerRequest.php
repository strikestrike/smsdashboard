<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSendingServerRequest extends FormRequest
{
    // public function authorize()
    // {
    //    return Gate::allows('sending_server_create');
    // }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:sending_servers',
            ],
        ];
    }
}
