@extends('../layouts.provider_temp')



@section('content')

 

 <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="row dash_head">

          <div class="col-md-6 col-sm-6">

              <div class="row dash_info border">

                    <div class="col-md-3">

                        <img src="{{asset('provider_backend/img/dash_user.png')}}">

                    </div>

                    <div class="col-md-9">

                        <h4>Total Number of clients</h4>

                        <h5>{{ $TotalNumberofUsers}}</h5>

                    </div>

              </div>

          </div>

          <div class="col-md-6 col-sm-6">

              <div class="row dash_info">

                    <div class="col-md-3">

                        <img src="{{asset('provider_backend/img/dash_cash.png')}}">

                    </div>

                    <div class="col-md-9">

                        <h4>Amount earned</h4>

                        <h5>{{ ($TotalAmount != '') ? conversion_pound_without_currency($TotalAmount) : '0' }}</h5>

                    </div>

              </div>

          </div>

      </div>

    </section> 
    @if($bankacStatus == '0')

      <div class="alert alert-warning alert-white rounded notify">
          <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
          <div class="icon"> <i class="fa fa-exclamation-triangle"></i></div> Please submit your bank account details for the future transactions.</div>

    @endif
    

    <section class="chart_cols">

        <h3 class="box-title">Appointments and Earnings </h3>

              <div class="row">

            <div class="col-md-6">



                <div class="chart">

                <canvas id="areaChart" style="height:250px"></canvas>

              </div>

            </div>

            <div class="col-md-6">    

                <div class="chart">

                  <canvas id="barChart" style="height:250px"></canvas>

                </div>

            </div>

        </div>

    </section> 

  </div>



<script>

    $(function () {





        $.ajax({ url: APP_URL+"/provider/home_graphs_content",

            context: document.body,

            success: function(data){

             // alert(data.amount);

        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

        // This will get the first returned node in the jQuery collection.

        var areaChart       = new Chart(areaChartCanvas)



        var areaChartData = {

            labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

            datasets: [

                {

                    label               : 'Electronics',

                    fillColor           : '#61bce2',

                    strokeColor         : '#61bce2',

                    pointColor          : '#3b8bba',

                    pointStrokeColor    : '#c1c7d1',

                    pointHighlightFill  : '#fff',

                    pointHighlightStroke: 'rgba(220,220,220,1)',

                    data                : data.users

                },

                {

                    label               : 'Digital Goods',

                    fillColor           : '#fb7b5f',

                    strokeColor         : '#fb7b5f',

                    pointColor          : '#3b8bba',

                    pointStrokeColor    : '#fb7b5f',

                    pointHighlightFill  : '#fff',

                    pointHighlightStroke: 'rgba(60,141,188,1)',

                    data                : data.amount

                }

            ]

        }



        var areaChartOptions = {

            //Boolean - If we should show the scale at all

            showScale               : true,

            //Boolean - Whether grid lines are shown across the chart

            scaleShowGridLines      : false,

            //String - Colour of the grid lines

            scaleGridLineColor      : 'rgba(0,0,0,.05)',

            //Number - Width of the grid lines

            scaleGridLineWidth      : 1,

            //Boolean - Whether to show horizontal lines (except X axis)

            scaleShowHorizontalLines: true,

            //Boolean - Whether to show vertical lines (except Y axis)

            scaleShowVerticalLines  : true,

            //Boolean - Whether the line is curved between points

            bezierCurve             : true,

            //Number - Tension of the bezier curve between points

            bezierCurveTension      : 0.3,

            //Boolean - Whether to show a dot for each point

            pointDot                : false,

            //Number - Radius of each point dot in pixels

            pointDotRadius          : 4,

            //Number - Pixel width of point dot stroke

            pointDotStrokeWidth     : 1,

            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point

            pointHitDetectionRadius : 20,

            //Boolean - Whether to show a stroke for datasets

            datasetStroke           : true,

            //Number - Pixel width of dataset stroke

            datasetStrokeWidth      : 2,

            //Boolean - Whether to fill the dataset with a color

            datasetFill             : true,

            //String - A legend template

            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',

            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container

            maintainAspectRatio     : true,

            //Boolean - whether to make the chart responsive to window resizing

            responsive              : true

        }



        //Create the line chart

        areaChart.Line(areaChartData, areaChartOptions)

        //-------------

        //- BAR CHART -

        //-------------

        var barChartCanvas                   = $('#barChart').get(0).getContext('2d')

        var barChart                         = new Chart(barChartCanvas)

        var barChartData                     = areaChartData

        barChartData.datasets[1].fillColor   = '#fb7b5f'

        barChartData.datasets[1].strokeColor = '#fb7b5f'

        barChartData.datasets[1].pointColor  = '#fb7b5f'

        var barChartOptions                  = {

            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value

            scaleBeginAtZero        : true,

            //Boolean - Whether grid lines are shown across the chart

            scaleShowGridLines      : true,

            //String - Colour of the grid lines

            scaleGridLineColor      : 'rgba(0,0,0,.05)',

            //Number - Width of the grid lines

            scaleGridLineWidth      : 1,

            //Boolean - Whether to show horizontal lines (except X axis)

            scaleShowHorizontalLines: true,

            //Boolean - Whether to show vertical lines (except Y axis)

            scaleShowVerticalLines  : true,

            //Boolean - If there is a stroke on each bar

            barShowStroke           : true,

            //Number - Pixel width of the bar stroke

            barStrokeWidth          : 2,

            //Number - Spacing between each of the X value sets

            barValueSpacing         : 5,

            //Number - Spacing between data sets within X values

            barDatasetSpacing       : 1,

            //String - A legend template

            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',

            //Boolean - whether to make the chart responsive

            responsive              : true,

            maintainAspectRatio     : true

        }



        barChartOptions.datasetFill = false

        barChart.Bar(barChartData, barChartOptions)



            }});

    })



</script>





@endsection

