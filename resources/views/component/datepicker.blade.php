
<div style="width: 450px" class="input-group date shadow-sm datepicker wd-300 me-2 mb-md-0" >
    <div id="datepicker" class="form-control text-center">
        <i class="mdi mdi-calendar"></i>
        <span></span> 
    </div>
</div>
@push('script')
    <script>
        var option = @json($option);
        if(option == "report"){
            var start = moment().startOf('month');
            var end = moment().endOf('month');
        }
        else{
            var start = moment().startOf('day').add(19,'hours');
            var end = moment().startOf('day').add(32,'hours');
        }
        
        function cb(start, end) {
            $('#datepicker span').html(start.format('MMMM D, YYYY h:mm A') + ' - ' + end.format('MMMM D, YYYY h:mm A'));
        }

        $('#datepicker').daterangepicker({
            startDate: start,
            endDate: end,
            timePicker:true,
            locale: {
                format: 'MM/DD/YYYY h:mm A'
            },
            showDropdowns: true 
            // ranges: {
            // 'Today':         [moment(), moment()],
            // 'Yesterday':     [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            // 'Last 7 Days':   [moment().subtract(6, 'days'), moment()],
            // 'Last 30 Days':  [moment().subtract(29, 'days'), moment()],
            // 'This Month':    [moment().startOf('month'), moment().endOf('month')],
            // 'Last Month':    [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            // 'This Year':    [moment().startOf('year'), moment().endOf('year')],
            // 'Last Year':     [moment().subtract(12, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            // }
        }, cb);
        cb(start, end);
    </script>
@endpush