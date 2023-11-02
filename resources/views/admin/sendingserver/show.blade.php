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
                            {{ __('cruds.sendingServer.fields.sender_number') }}
                        </th>
                        <td>
                            {{ $sendingserver->sender_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.sendingServer.fields.sender_api') }}
                        </th>
                        <td>
                            {{ $sendingserver->sender_api }}
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
