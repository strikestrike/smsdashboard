<x-admin>
    @section('title')
    {{ 'Dashboard' }}
    @endsection

    <div class="row">
        <div class="col-lg-12 col-12 my-2">
            <button type="button" class="btn btn-default float-right" id="daterange-btn">
                <i class="far fa-calendar-alt"></i> <span></span>
                <i class="fas fa-caret-down"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $leads_count }}</h3>
                    <p>Total Entries</p>
                </div>
                <div class="icon">
                    <i class="far fa-address-book"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $leads_count_with_successful_sms }}</h3>
                    <p>Validated Entries</p>
                </div>
                <div class="icon">
                    <i class="far fa-id-card"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $outbound_sms_count }}</h3>
                    <p>Outbound SMS</p>
                </div>
                <div class="icon">
                    <i class="far fa-arrow-alt-circle-right"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $inbound_sms_count }}</h3>
                    <p>Inbound SMS</p>
                </div>
                <div class="icon">
                    <i class="far fa-arrow-alt-circle-left"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $unsubscribed_campaigns_count }}</h3>
                    <p>Unsubscribed</p>
                </div>
                <div class="icon">
                    <i class="fas fa-history"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $ongoing_campaigns_count }}</h3>
                    <p>On-going Campaigns</p>
                </div>
                <div class="icon">
                    <i class="far fa-chart-bar"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    @section('page_scripts')
    <script>
        $(function() {
            var startDate = '{{ $startDate }}';
            var endDate = '{{ $endDate }}';

            function updateDateRangeText(start, end) {
                const selectedText = start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');
                $('#daterange-btn span').text(selectedText);
            }


            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment(startDate),
                    endDate: moment()
                },
                function(start, end) {
                    const startDate = start.format('YYYY-MM-DD 00:00:00');
                    const endDate = end.format('YYYY-MM-DD 23:59:59');
                    updateDateRangeText(start, end);

                    const url = '{{ route('admin.dashboard') }}?start_date=' + startDate + '&end_date=' + endDate;
                    window.location.href = url;
                }
            );

            updateDateRangeText(moment(startDate), moment(endDate));
        });
    </script>
    @endsection
</x-admin>
