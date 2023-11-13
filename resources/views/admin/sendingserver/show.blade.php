<x-admin>
    @section('title')
        {{ __('cruds.sendingServer.title_singular') }}
    @endsection

<div class="card">
    <div class="card-header">
        <h4>{{ __('global.show') }} {{ __('cruds.sendingServer.title_singular') }}</h4>
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sendingservers.index') }}">
                    {{ __('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __('cruds.sendingServer.fields.id') }}
                        </th>
                        <td>
                            {{ $sendingserver->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.sendingServer.fields.name') }}
                        </th>
                        <td>
                            {{ $sendingserver->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.sendingServer.fields.product_token') }}
                        </th>
                        <td>
                            {{ $sendingserver->product_token }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.sendingServer.fields.api_key') }}
                        </th>
                        <td>
                            {{ $sendingserver->api_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.sendingServer.fields.api_endpoint') }}
                        </th>
                        <td>
                            {{ $sendingserver->api_endpoint }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.sendingServer.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $sendingserver->phone_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sendingservers.index') }}">
                    {{ __('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

</x-admin>
