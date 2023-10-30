<x-admin>
    @section('title')
        {{ 'Campaign' }}
    @endsection

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>{{ trans('global.create') }} {{ trans('cruds.campaign.title_singular') }}</h4>
                </div>

                <div class="card-body p-5">
                    <form class="form-horizontal" method="POST" action="{{ route("admin.campaigns.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="name">{{ trans('cruds.campaign.fields.name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.campaign.fields.name_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="tags">{{ trans('cruds.campaign.fields.tags') }}</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" multiple="multiple" name="tags" id="tags" value="{{ old('name', '') }}" data-placeholder="Select Tags" style="width: 100%;" required>
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                                @if($errors->has('tags'))
                                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.campaign.fields.tags_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="counties">{{ trans('cruds.campaign.fields.counties') }}</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control {{ $errors->has('counties') ? 'is-invalid' : '' }}" multiple="multiple" name="counties" id="counties" value="{{ old('counties', '') }}" data-placeholder="Select Counties" style="width: 100%;" required>
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                                @if($errors->has('counties'))
                                    <span class="text-danger">{{ $errors->first('counties') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.campaign.fields.counties_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="exclusions">{{ trans('cruds.campaign.fields.exclusions') }}</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control {{ $errors->has('exclusions') ? 'is-invalid' : '' }}" multiple="multiple" name="exclusions" id="exclusions" value="{{ old('exclusions', '') }}" data-placeholder="Select Exclusions" style="width: 100%;" required>
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                                @if($errors->has('exclusions'))
                                    <span class="text-danger">{{ $errors->first('exclusions') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.campaign.fields.exclusions_helper') }}</span>
                            </div>
                            <div class="col-sm-12">
                                <p class="text-muted text-right">Recipients: <span id="recipients_count">238</span></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="servers">{{ trans('cruds.campaign.fields.servers') }}</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control {{ $errors->has('servers') ? 'is-invalid' : '' }}" multiple="multiple" name="servers" id="servers" value="{{ old('servers', '') }}" data-placeholder="Select Servers" style="width: 100%;" required>
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                                @if($errors->has('servers'))
                                    <span class="text-danger">{{ $errors->first('servers') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.campaign.fields.servers_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="template">{{ trans('cruds.campaign.fields.template') }}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="template" id="template" rows="3" placeholder="Type your message"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <p class="text-muted text-right">Characters: <span id="template_length">58</span>/<span id="max_length">156</span></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-2">
                            <p class="text-info">Scheduled at 2023/11/15 08:30 am</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <a class="text-primary text-left" href="javascript:;"><i class="fas fa-calendar-day"></i> Schedule Message</a>
                            <button class="btn btn-success float-right" type="submit">
                                <i class="fas fa-paper-plane"></i>
                                {{ trans('global.send') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('page_scripts')
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2()
        });
    </script>
    @endsection

</x-admin>
