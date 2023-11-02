<x-admin>
    @section('title')
    {{ __('cruds.sendingServer.title') }}
    @endsection

    {{--    @can('lead_create')--}}
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 text-right">
            <a class="btn btn-success" href="{{ route('admin.sendingservers.create') }}">
                {{ __('global.add') }} {{ __('cruds.sendingServer.title_singular') }}
            </a>
        </div>
    </div>
    {{--    @endcan--}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><th>{{ __('cruds.sendingServer.title') }}</th></h3>
        </div>
        <div class="card-body">
            <input type="hidden" name="selected_lead_ids" value="">
            <table class="table table-striped datatable-Lead" width="100%">
                <thead>
                <tr>
                    <th width="10">
                    </th>
                    <th>{{ __('cruds.sendingServer.fields.id') }}</th>
                    <th>{{ __('cruds.sendingServer.fields.name') }}</th>
                    <th>{{ __('cruds.sendingServer.fields.sender_number') }}</th>
                    <th>{{ __('cruds.sendingServer.fields.sender_api') }}</th>
                    <th>{{ __('cruds.sendingServer.fields.created_at') }}</th>
                    <th>{{ __('global.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
                    url: "{{ route('admin.sendingservers.massDestroy') }}",
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
                {{--                @endcan--}}

                let dtOverrideGlobals = {
                    buttons: dtButtons,
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    aaSorting: [],
                    ajax: "{{ route('admin.sendingservers.index') }}",
                    columns: [
                        { data: 'placeholder', name: 'placeholder' },
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'sender_number', name: 'sender_number' },
                        { data: 'sender_api', name: 'sender_api' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', sortable: false, searchable: false }
                    ],
                    colVis: {
                        exclude: [ 0]
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
