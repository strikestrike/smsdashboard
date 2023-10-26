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
                    <input class="form-control {{ $errors->has('origin') ? 'is-invalid' : '' }}" type="text" name="origin" id="origin" value="{{ old('origin', '') }}">
                    @if($errors->has('origin'))
                        <span class="text-danger">{{ $errors->first('origin') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lead.fields.origin_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="tag_id">{{ trans('cruds.lead.fields.tags') }}</label>
                    <input class="form-control {{ $errors->has('tag_id') ? 'is-invalid' : '' }}" type="text" name="tag_id" id="tag_id" value="{{ old('tag_id', '') }}">
                    @if($errors->has('tag_id'))
                        <span class="text-danger">{{ $errors->first('tag_id') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lead.fields.tags_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="used_campaigns_ids">{{ trans('cruds.lead.fields.used_campaigns') }}</label>
                    <input class="form-control {{ $errors->has('used_campaigns_ids') ? 'is-invalid' : '' }}" type="text" name="used_campaigns_ids" id="used_campaigns_ids" value="{{ old('used_campaigns_ids', '') }}">
                    @if($errors->has('used_campaigns_ids'))
                        <span class="text-danger">{{ $errors->first('used_campaigns_ids') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lead.fields.used_campaigns_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="exclude_campaigns_ids">{{ trans('cruds.lead.fields.exclude_campaigns') }}</label>
                    <input class="form-control {{ $errors->has('exclude_campaigns_ids') ? 'is-invalid' : '' }}" type="text" name="exclude_campaigns_ids" id="exclude_campaigns_ids" value="{{ old('used_campaigns_ids', '') }}">
                    @if($errors->has('exclude_campaigns_ids'))
                        <span class="text-danger">{{ $errors->first('exclude_campaigns_ids') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.lead.fields.exclude_campaigns_helper') }}</span>
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
    </script>
    @endsection

</x-admin>
