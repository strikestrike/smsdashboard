<x-admin>
    @section('title')
    {{ 'Mail Servers' }}
    @endsection
    @section('page_styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Mail Servers</h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Origin</th>
                        <th>Tags</th>
                        <th>Campagin Used</th>
                        <th>Campagin Exculusion</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $lead)
                    <tr>
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->name }}</td>
                        <td>{{ $lead->email }}</td>
                        <td>{{ $lead->phone }}</td>
                        <td>{{ $lead->origin }}</td>
                        <td>{{ $lead->tags_str }}</td>
                        <td>{{ $lead->campagins_used_str }}</td>
                        <td>{{ $lead->campagins_exclusion_str }}</td>
                        <td>{{ $lead->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @section('page_scripts')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- <script src="{{ asset('admin/pages/customer_index.js') }}"></script> -->
    @endsection
</x-admin>