<x-admin>
    @section('title')
        {{ trans('cruds.sendingServer.title_singular') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h4>{{ trans('global.edit') }} {{ trans('cruds.sendingServer.title_singular') }}</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.sendingservers.update", [$sendingserver->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.sendingServer.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $sendingserver->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sender_number">{{ trans('cruds.sendingServer.fields.sender_number') }}</label>
                    <input class="form-control {{ $errors->has('sender_number') ? 'is-invalid' : '' }}" type="text" name="sender_number" id="sender_number" value="{{ old('email', $sendingserver->sender_number) }}">
                    @if($errors->has('sender_number'))
                        <span class="text-danger">{{ $errors->first('sender_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.sender_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="sender_api">{{ trans('cruds.sendingServer.fields.sender_api') }}</label>
                    <input class="form-control {{ $errors->has('sender_api') ? 'is-invalid' : '' }}" type="text" name="sender_api" id="sender_api" value="{{ old('phone', $sendingserver->sender_api) }}">
                    @if($errors->has('sender_api'))
                        <span class="text-danger">{{ $errors->first('sender_api') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.sender_api_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-admin>
