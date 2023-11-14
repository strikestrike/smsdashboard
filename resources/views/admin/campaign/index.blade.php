<x-admin>
    @section('title')
    {{ 'Campagin' }}
    @endsection

    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab_ongoing_btn" data-toggle="tab" href="#tab_ongoing" role="tab" aria-controls="tab_ongoing" aria-selected="true">Ongoing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab_history_btn" data-toggle="tab" href="#tab_history" role="tab" aria-controls="tab_history" aria-selected="false">History</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="tab_ongoing" role="tabpanel" aria-labelledby="tab_ongoing_btn">
                    <table class="table table-striped datatable-ongoing" width="100%">
                        <thead>
                        <tr>
                            <th width="10"></th>
                            <th>{{ __('cruds.campaign.fields.id') }}</th>
                            <th>{{ __('cruds.campaign.fields.name') }}</th>
                            <th>{{ __('cruds.campaign.fields.tags') }}</th>
                            <th>{{ __('cruds.campaign.fields.servers') }}</th>
                            <th>{{ __('cruds.campaign.fields.created_at') }}</th>
                            <th>{{ __('cruds.campaign.fields.scheduled_at') }}</th>
                            <th>{{ __('cruds.campaign.fields.completed_at') }}</th>
                            <th>{{ __('global.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab_history" role="tabpanel" aria-labelledby="tab_history_btn">
                    <table class="table table-striped datatable-history" width="100%">
                        <thead>
                        <tr>
                            <th width="10"></th>
                            <th>{{ __('cruds.campaign.fields.id') }}</th>
                            <th>{{ __('cruds.campaign.fields.name') }}</th>
                            <th>{{ __('cruds.campaign.fields.tags') }}</th>
                            <th>{{ __('cruds.campaign.fields.servers') }}</th>
                            <th>{{ __('cruds.campaign.fields.created_at') }}</th>
                            <th>{{ __('cruds.campaign.fields.scheduled_at') }}</th>
                            <th>{{ __('cruds.campaign.fields.completed_at') }}</th>
                            <th>{{ __('global.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @section('page_scripts')
    <script type="text/javascript">
        $(function () {
            function format(d) {
                // `d` is the original data object for the row
                return (
                    '<dl>' +
                    '<dt>Message:</dt>' +
                    '<dd>' +
                    d.template +
                    '</dd>' +
                    '<dt>Sent:</dt>' +
                    '<dd>' +
                    0 +
                    '</dd>' +
                    '<dt>unDelivered:</dt>' +
                    '<dd>50</dd>' +
                    '</dl>'
                );
            }

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            {{--                @can('company_delete')--}}
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.campaigns.massDestroy') }}",
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
            dtButtons.push(deleteButton)
            {{--                @endcan--}}

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    type: 'GET',
                    headers: {'x-csrf-token': _token},
                    url: "{{ route('admin.campaigns.index') }}",
                    data: {
                        type: 'ongoing',
                    },
                },
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'tag_names', name: 'tag_names'},
                    { data: 'server_names', name: 'server_names'},
                    { data: 'created_at', name: 'created_at'},
                    { data: 'scheduled_at', name: 'scheduled_at'},
                    { data: 'completed_at', name: 'completed_at'},
                    { data: 'actions', sortable: false, searchable: false }
                ],
                colVis: {
                    exclude: [ 0 ]
                },
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 20,
            };
            let table_ongoing = $('.datatable-ongoing').DataTable(dtOverrideGlobals);
            dtOverrideGlobals.ajax.data.type = 'history';
            let table_history = $('.datatable-history').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            // Add event listener for opening and closing details
            table_ongoing.on('click', 'td.dt-control', function (e) {
                let tr = e.target.closest('tr');
                let row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                }
                else {
                    // Open this row
                    row.child(format(row.data())).show();
                }
            });

            table_history.on('click', 'td.dt-control', function (e) {
                let tr = e.target.closest('tr');
                let row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                }
                else {
                    // Open this row
                    row.child(format(row.data())).show();
                }
            });

        });
    </script>
    @endsection
</x-admin>
