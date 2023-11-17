<x-admin>
    @section('title')
    {{ trans('cruds.campaign.title_singular') }}
    @endsection

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>{{ trans('global.create') }} {{ trans('cruds.campaign.title_singular') }}</h4>
                </div>

                <div class="card-body p-5">
                    <form class="form-horizontal" method="POST" action="{{ route("admin.campaigns.update", [$campaign->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="name">{{ trans('cruds.campaign.fields.name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $campaign->name) }}" placeholder="Campaign Name" required>
                                @if($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.campaign.fields.name_helper') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="tags">{{ trans('cruds.campaign.fields.tags') }}</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" multiple="multiple" name="tags[]" data-placeholder="Select Tags" style="width: 100%;">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ $campaign->tags->contains('id', $tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                    @endforeach
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
                                <select class="select2 form-control {{ $errors->has('counties') ? 'is-invalid' : '' }}" multiple="multiple" name="countries[]" id="v" data-placeholder="Select Countries" style="width: 100%;">
                                    <option></option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ $campaign->countries->contains('id', $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
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
                                <select class="select2 form-control {{ $errors->has('exclusions') ? 'is-invalid' : '' }}" multiple="multiple" name="exclusions[]" data-placeholder="Select Servers" style="width: 100%;">
                                    @foreach($servers as $server)
                                        <option value="{{ $server->id }}" {{ $campaign->exclusions->contains('id', $server->id) ? 'selected' : '' }}>{{ $server->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('exclusions'))
                                    <span class="text-danger">{{ $errors->first('exclusions') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.campaign.fields.exclusions_helper') }}</span>
                            </div>
{{--                            <div class="col-sm-12">--}}
{{--                                <p class="text-muted text-right">Recipients: <span id="recipients_count">238</span></p>--}}
{{--                            </div>--}}
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-right required" for="servers">{{ trans('cruds.campaign.fields.servers') }}</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control {{ $errors->has('servers') ? 'is-invalid' : '' }}" multiple="multiple" name="servers[]" data-placeholder="Select Servers" style="width: 100%;">
                                    @foreach($servers as $server)
                                        <option value="{{ $server->id }}" {{ $campaign->sendingServers->contains('id', $server->id) ? 'selected' : '' }}>{{ $server->name }}</option>
                                    @endforeach
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
                                <textarea class="form-control" name="template" id="template" rows="3" placeholder="Type your message">{{ old('template', $campaign->template) }}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <p class="text-muted text-right">Characters: <span id="template_length">58</span>/<span id="max_length">156</span></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-2">
                                <p class="text-info scheduled_at_text"><?php echo $campaign->scheduled_at ? 'Scheduled At: ' . $campaign->scheduled_at : '' ?></p>
                                <input type="hidden" name="scheduled_at" value="<?php echo $campaign->scheduled_at ?? '' ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <a class="text-primary text-left" href="#" data-toggle="modal" data-target="#scheduleDateModal">
                                <i class="fas fa-calendar-day"></i> Schedule Message
                            </a>
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

    <div class="modal fade" id="scheduleDateModal" tabindex="-1" aria-labelledby="scheduleDateModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Campaign Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select a date</label>
                        <div class="input-group date datepickers" id="scheduledatepicker" data-target-input="nearest">
                            <input type="text" class="form-control" id="scheduledate" data-target="#scheduledatepicker"/>
                            <div class="input-group-append" data-target="#scheduledatepicker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" id="save_schedule_date">Save</button>
                </div>
            </div>
        </div>
    </div>

    @section('page_scripts')
    <script>
        $(function() {
            $('#scheduledatepicker').datetimepicker({ icons: { time: 'far fa-clock' } });
            $('#save_schedule_date').click(function () {
                let schedule_date = $('#scheduledate').val();
                if (schedule_date) {
                    $('.scheduled_at_text').html('Scheduled at ' + schedule_date);
                } else {
                    $('.scheduled_at_text').html('&nbsp;');
                }
                const parsedDate = moment(schedule_date, 'MM/DD/YYYY h:mm A');
                const formattedDate = parsedDate.format('YYYY-MM-DD HH:mm:ss');
                $('[name=scheduled_at]').val(formattedDate);
                console.log(schedule_date, formattedDate);
                $('#scheduleDateModal').modal('hide');
            })
        });
    </script>
    @endsection
</x-admin>
