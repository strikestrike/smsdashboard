<x-admin>
    @section('title')
        {{ 'Lead' }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h4>{{ trans('global.create') }} {{ trans('cruds.lead.title_singular') }}</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.leads.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.lead.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lead.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('cruds.lead.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lead.fields.email_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="phone">{{ trans('cruds.lead.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lead.fields.phone_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="origin">{{ trans('cruds.lead.fields.origin') }}</label>
                    <select class="select2 form-control {{ $errors->has('origin') ? 'is-invalid' : '' }}" name="origin" id="v" data-placeholder="Select Country" style="width: 100%;">
                        <option></option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ $country->id == old('origin', '') ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('origin'))
                        <span class="text-danger">{{ $errors->first('origin') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lead.fields.origin_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="tags">{{ trans('cruds.tag.title') }}</label>
                    <select class="select2 form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" multiple="multiple" name="tags[]" data-placeholder="Select Tags" style="width: 100%;">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label for="servers">{{ trans('cruds.exclusion.title') }}</label>
                    <select class="select2 form-control {{ $errors->has('servers') ? 'is-invalid' : '' }}" multiple="multiple" name="servers[]" data-placeholder="Select Servers" style="width: 100%;">
                        @foreach($servers as $server)
                            <option value="{{ $server->id }}" {{ in_array($tag->id, old('servers', [])) ? 'selected' : '' }}>{{ $server->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @section('page_scripts')
        <script>
            $(function() {
                $('.select2[name="tags[]"]').select2({tags: true});
            });
        </script>
    @endsection

</x-admin>
