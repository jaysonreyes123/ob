  <!-- Line Chart -->
  <div id="bar_chart"></div>
  @push('script')
  <script>
    var month = ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov','Dec'];
    var data = [];
    var bar_chart;
    for (let i = 0; i < 12; i++) {
        data.push(0)
    }    

    bar_chart = new ApexCharts(document.querySelector("#bar_chart"), {
        series:[
            {
                name: 'Sales',
                data: data
            }
        ],
        chart: {
          height: 350,
          type: 'bar',
          toolbar: {
            show: false
          },
        },
        markers: {
          size: 4
        },
        colors: ['#2eca6a'],

        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2
        },
        xaxis: {
            categories: month,
        },
        yaxis:{
            labels:{
                show:false
            }
        },
        tooltip: {
            intersect: false,
            followCursor: true,
        }
      })
      bar_chart.render();
  </script>
  <!-- End Line Chart -->
  @endpush
  