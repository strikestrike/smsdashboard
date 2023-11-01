<?php

namespace App\Http\Requests;

use App\Models\Lead;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassExcludeLeadRequest extends FormRequest
{
    // public function authorize()
    // {
    //    abort_if(Gate::denies('exclusion_assign'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return true;
    // }

    public function rules()
    {
        return [
            'lead_ids'   => 'required|array',
            'lead_ids.*' => 'exists:leads,id',
            'server_ids'   => 'required|array',
            'server_ids.*' => 'exists:sending_servers,id',
        ];
    }
}
