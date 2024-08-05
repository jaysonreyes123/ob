  <!-- Line Chart -->
  <div id="hourly_chart"></div>
  @push('script')
  <script>
    var hour = [];
    var data = [];
    var hourly_chart;
    for (let i = 0; i < 24; i++) {
        hour.push(i < 10 ? "0"+i+":00" : i+":00");
        data.push(0)
    }
     hourly_chart = new ApexCharts(document.querySelector("#hourly_chart"), {
        series: [{
          name: 'Sales',
          data: data,
        }, {
          name: 'Sales Failed',
          data: data
        }, {
          name: 'Customers',
          data: data
        }],
        chart: {
          height: 350,
          type: 'line',
          toolbar: {
            show: false
          },
        },
        markers: {
          size: 4
        },
        colors: ['#2eca6a', '#F15B46', '#4154f1'],

        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
          type: 'time',
          categories: hour
        },
        yaxis:{
            labels:{
                show:false
            }
        },
        tooltip: {
          x: {
            format: 'HH:mm'
          },
          
        }
      })
    hourly_chart.render();
  </script>
  <!-- End Line Chart -->
  @endpush
  