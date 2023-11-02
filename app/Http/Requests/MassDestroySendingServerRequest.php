<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySendingServerRequest extends FormRequest
{
    // public function authorize()
    // {
    //    abort_if(Gate::denies('sending_server_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sending_servers,id',
        ];
    }
}
