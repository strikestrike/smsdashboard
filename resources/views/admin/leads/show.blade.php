<x-admin>
    @section('title')
        {{ 'Lead' }}
    @endsection

<div class="card">
    <div class="card-header">
        <h4>{{ __('global.show') }} {{ __('cruds.lead.title') }}</h4>
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.leads.index') }}">
                    {{ __('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __('cruds.lead.fields.id') }}
                        </th>
                        <td>
                            {{ $lead->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.lead.fields.name') }}
                        </th>
                        <td>
                            {{ $lead->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.lead.fields.email') }}
                        </th>
                        <td>
                            {{ $lead->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.lead.fields.phone') }}
                        </th>
                        <td>
                            {{ $lead->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.lead.fields.origin') }}
                        </th>
                        <td>
                            {{ $lead->origin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.lead.fields.tags') }}
                        </th>
                        <td>
                            {{ $lead->tags->pluck('name')->implode(', ') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.lead.fields.exclusions') }}
                        </th>
                        <td>
                            {{ $lead->excludedServers()->pluck('name')->implode(', ') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.leads.index') }}">
                    {{ __('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

</x-admin>
