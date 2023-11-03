<x-admin>
    @section('title')
        {{ __('cruds.campaign.title_singular') }}
    @endsection

<div class="card">
    <div class="card-header">
        <h4>{{ __('global.show') }} {{ __('cruds.campaign.title_singular') }}</h4>
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.campaigns.index') }}">
                    {{ __('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __('cruds.campaign.fields.id') }}
                        </th>
                        <td>
                            {{ $campaign->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.campaign.fields.name') }}
                        </th>
                        <td>
                            {{ $campaign->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.campaign.fields.template') }}
                        </th>
                        <td>
                            {{ $campaign->template }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.campaign.fields.tags') }}
                        </th>
                        <td>
                            {{ $campaign->tags->pluck('name')->implode(', ') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.campaign.fields.servers') }}
                        </th>
                        <td>
                            {{ $campaign->sendingServers->pluck('name')->implode(', ') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.campaign.fields.countries') }}
                        </th>
                        <td>
                            {{ $campaign->countries->pluck('name')->implode(', ') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('cruds.campaign.fields.exclusions') }}
                        </th>
                        <td>
                            {{ $campaign->exclusions->pluck('name')->implode(', ') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.campaigns.index') }}">
                    {{ __('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

</x-admin>
