<x-admin>
    @section('title')
    {{ __('cruds.lead.title') }}
    @endsection

{{--    @can('lead_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 text-right">
            <a class="btn btn-success" href="{{ route('admin.leads.create') }}">
                {{ __('global.add') }} {{ __('cruds.lead.title_singular') }}
            </a>
        </div>
    </div>
{{--    @endcan--}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><th>{{ __('cruds.lead.title') }}</th></h3>
        </div>
        <div class="card-body">
            <input type="hidden" name="selected_lead_ids" value="">
            <table class="table table-striped datatable-Lead" width="100%">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>{{ __('cruds.lead.fields.id') }}</th>
                        <th>{{ __('cruds.lead.fields.name') }}</th>
                        <th>{{ __('cruds.lead.fields.email') }}</th>
                        <th>{{ __('cruds.lead.fields.phone') }}</th>
                        <th>{{ __('cruds.lead.fields.origin') }}</th>
                        <th>{{ __('cruds.lead.fields.tags') }}</th>
                        <th>{{ __('cruds.lead.fields.exclusions') }}</th>
                        <th>{{ __('cruds.lead.fields.used_campaigns') }}</th>
                        <th>{{ __('cruds.lead.fields.created_at') }}</th>
                        <th>{{ __('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-tags">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign Tags</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tags">{{ trans('cruds.exclusion.title') }}</label>
                        <select class="select2 form-control" multiple="multiple" name="tags" id="tags" data-placeholder="Select Tags" style="width: 100%;" required>
                            @foreach($tags as $key => $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_tags">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-exclusions">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Assign Exculsions</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="servers">{{ trans('cruds.exclusion.title') }}</label>
                        <select class="select2 form-control" multiple="multiple" name="servers" id="servers" data-placeholder="Select Servers" style="width: 100%;" required>
                        @foreach($servers as $key => $server)
                            <option value="{{ $server->id }}">{{ $server->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save_exclusions">Save</button>
                </div>
            </div>
        </div>
    </div>

    @section('page_scripts')
    <script type="text/javascript">
        $(function () {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
{{--                @can('company_delete')--}}
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.leads.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { table.ajax.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton);

            $("#save_tags").on("click", function () {
                var sectedLeads = $('input[name=selected_lead_ids]').val();
                if (sectedLeads.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')
                    return
                }
                var selectedTags = $("#tags").select2('val');
                $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: "{{ route('admin.leads.assignTags') }}",
                    data: { lead_ids: sectedLeads.split(','), tag_ids: selectedTags, _method: 'POST' }})
                    .done(function (response) {
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        })
                        table.ajax.reload();
                        $("#modal-tags").modal("hide");
                    });
            });

            $("#save_exclusions").on("click", function () {
                var sectedLeads = $('input[name=selected_lead_ids]').val();
                if (sectedLeads.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')
                    return
                }
                var selectedServers = $("#servers").select2('val');
                $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: "{{ route('admin.leads.assignExclusions') }}",
                    data: { lead_ids: sectedLeads.split(','), server_ids: selectedServers, _method: 'POST' }})
                    .done(function (response) {
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        })
                        table.ajax.reload();
                        $("#modal-exclusions").modal("hide");
                    });
            });

            let tagsButtonTrans = '{{ trans('cruds.lead.assign_tags') }}';
            let tagsButton = {
                text: tagsButtonTrans,
                className: 'btn-primary',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
                    });
                    $('input[name=selected_lead_ids]').val(ids.join(','));

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    $("#tags").val(null).trigger("change");
                    $("#modal-tags").modal("show");
                }
            }
            dtButtons.push(tagsButton);

            let exclusionsButtonTrans = '{{ trans('cruds.lead.assign_exclusions') }}';
            let exclusionsButton = {
                text: exclusionsButtonTrans,
                className: 'btn-warning',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                        return entry.id
                    });
                    $('input[name=selected_lead_ids]').val(ids.join(','));

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    $("#servers").val(null).trigger("change");
                    $("#modal-exclusions").modal("show");
                }
            }
            dtButtons.push(exclusionsButton)
{{--                @endcan--}}

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.leads.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'country', name: 'country' },
                    { data: 'tag_names', name: 'tag_names' },
                    { data: 'exclusion_names', name: 'exclusion_names' },
                    { data: 'used_campaigns', name: 'used_campaigns' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', sortable: false, searchable: false }
                ],
                colVis: {
                    exclude: [ 0, 1, 2 ]
                },
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 20,
            };
            let table = $('.datatable-Lead').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
    @endsection
</x-admin>
