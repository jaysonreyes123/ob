  <!-- Line Chart -->
  <div id="{{$id}}"></div>
  @push('script')
    <script>
      var id = @json($id);
      var data = @json($data);
      var label = @json($label);
      var color = @json($color);
      var pie;
      pie = new ApexCharts(document.querySelector("#"+id),{
          series: data,
          chart: {
          width: '100%',
          height:'350',
          type: 'pie',
        },
        colors: color,
        labels: label,
        responsive: [{
          breakpoint: 300,
          options: {
            chart: {
              width: 500,
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
      })
      pie.render()
    </script>
  @endpush