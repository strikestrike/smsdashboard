<x-admin>
    @section('title')
    {{ 'Lead' }}
    @endsection

    @section('page_styles')

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
            <table class="table table-striped datatable-Lead">
                <thead>
                    <tr>
                        <th width="10">
                        </th>
                        <th>{{ __('cruds.lead.fields.id') }}</th>
                        <th>{{ __('cruds.lead.fields.name') }}</th>
                        <th>{{ __('cruds.lead.fields.email') }}</th>
                        <th>{{ __('cruds.lead.fields.phone') }}</th>
                        <th>{{ __('cruds.lead.fields.origin') }}</th>
{{--                        <th>{{ __('cruds.lead.fields.tags') }}</th>--}}
                        <th>{{ __('cruds.lead.fields.used_campaigns') }}</th>
                        <th>{{ __('cruds.lead.fields.exclude_campaigns') }}</th>
                        <th>{{ __('cruds.lead.fields.created_at') }}</th>
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
                            .done(function () { location.reload() })
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
                ajax: "{{ route('admin.leads.index') }}",
                columns: [
                    { data: 'placeholder', name: 'placeholder' },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'origin', name: 'origin' },
                    // { data: 'tag_id', name: 'tag_id' },
                    { data: 'used_campaigns_ids', name: 'used_campaigns_ids' },
                    { data: 'exclude_campaigns_ids', name: 'exclude_campaigns_ids' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', sortable: false, searchable: false }
                ],
                colVis: {
                    exclude: [ 0, 1, 2 ]
                },
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 100,
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
