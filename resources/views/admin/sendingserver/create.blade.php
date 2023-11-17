<x-admin>
    @section('title')
        {{ trans('cruds.sendingServer.title_singular') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h4>{{ trans('global.create') }} {{ trans('cruds.sendingServer.title_singular') }}</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.sendingservers.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.sendingServer.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="product_token">{{ trans('cruds.sendingServer.fields.product_token') }}</label>
                    <input class="form-control {{ $errors->has('product_token') ? 'is-invalid' : '' }}" type="text" name="product_token" id="product_token" value="{{ old('product_token', '') }}" required>
                    @if($errors->has('product_token'))
                        <span class="text-danger">{{ $errors->first('product_token') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.product_token_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="api_key">{{ trans('cruds.sendingServer.fields.api_key') }}</label>
                    <input class="form-control {{ $errors->has('api_key') ? 'is-invalid' : '' }}" type="text" name="api_key" id="api_key" value="{{ old('api_key', '') }}" required>
                    @if($errors->has('product_token'))
                        <span class="text-danger">{{ $errors->first('api_key') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.api_key_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="api_endpoint">{{ trans('cruds.sendingServer.fields.api_endpoint') }}</label>
                    <input class="form-control {{ $errors->has('api_endpoint') ? 'is-invalid' : '' }}" type="text" name="api_endpoint" id="api_endpoint" value="{{ old('api_endpoint', '') }}" required>
                    @if($errors->has('product_token'))
                        <span class="text-danger">{{ $errors->first('api_endpoint') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.api_endpoint_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="phone_number">{{ trans('cruds.sendingServer.fields.phone_number') }}</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                    @if($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.phone_number_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="limits">{{ trans('cruds.sendingServer.fields.limits') }}</label>
                    <input class="form-control {{ $errors->has('limits') ? 'is-invalid' : '' }}" type="number" name="limits" id="limits" value="{{ old('limits') }}">
                    @if($errors->has('limits'))
                        <span class="text-danger">{{ $errors->first('limits') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.sendingServer.fields.limits_helper') }}</span>
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
