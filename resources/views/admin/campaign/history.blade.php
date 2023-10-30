<x-admin>
    @section('title')
    {{ 'Campagin' }}
    @endsection
    @section('page_styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Campaigns History</h3>
            <a class="btn btn-success float-right" href="#">
                <i class="fas fa-plus"></i>
                New
            </a>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped" id="history_table">
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
                </tbody>
            </table>
        </div>

    </div>

    </div>

    @section('page_scripts')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    @endsection
</x-admin>
