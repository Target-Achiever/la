@extends('../layouts.admin_temp')



@section('content')

<style>

 .small-box .icon {

        top: -22px;

        right: calc(12% - 50px);

    }

</style>

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

    	<div class="row">

    		<div class="col-md-7">

    			<h4>Link Aesthetics</h4>

    		</div>



    	</div>

          <div class="row">

              <div class="col-lg-6 col-xs-6">
                  <!-- small box -->
                  <a href="javascript:void(0)" class="search_count">
                      <div class="small-box bg-aqua">
                          <div class="inner">
                              <h3>{{ count($active_provider) }}</h3>
                              <p>Active Providers</p>
                          </div>
                          <div class="icon">
                              <img src="{{asset('admin_backend/img/dash_icon1.png')}}">
                          </div>
                      </div>
                  </a>
              </div>

        <!-- ./col -->

        <div class="col-lg-6 col-xs-6">

          <!-- small box -->

            <a href="{{ url('admin/pending_providers') }}">

          <div class="small-box bg-yellow">

            <div class="inner">

              <h3>{{ count($pending_provider) }}</h3>



              <p>Pending Providers</p>

            </div>

            <div class="icon">

            	<img src="{{asset('admin_backend/img/dash_icon1.png')}}">

            </div>           

          </div>

            </a>

        </div>

        <!-- ./col -->

        <div class="col-lg-6 col-xs-6">

          <!-- small box -->

            <a href="{{ url('admin/appointment_history') }}">

          <div class="small-box bg-green">

            <div class="inner">

              <h3>{{$earnings != '' ? conversion_to_pound($earnings) : '0'}}</h3>



              <p>Earnings</p>

            </div>

            <div class="icon">

            	<img src="{{asset('admin_backend/img/earning.png')}}">

            </div>           

          </div>

            </a>

        </div>

        <!-- ./col -->

        <div class="col-lg-6 col-xs-6">

          <!-- small box -->

            <a href="{{ url('admin/users') }}">

          <div class="small-box bg-red">

            <div class="inner">

              <h3>{{ count($active_user) }}</h3>



              <p>Total no of users</p>

            </div>

            <div class="icon">

            	<img src="{{asset('admin_backend/img/dash_icon1.png')}}">

            </div>           

          </div>

            </a>

        </div>

        <!-- ./col -->

      </div>

      <!-- /.row -->

    </section>    

     <section class="content-header">

      <h4>Activities trend</h4>

      	<div class="row chart_content">

      		<div class="col-md-6">

            	<div id="line-chart" style="height: 300px;"></div>

      		</div>

      	</div>

     </section>

  </div>

@endsection

@section('inline-scripts')
    
  $(document).ready(function()
{
  google.charts.load('current', {'packages':['controls', 'corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        
       var data = $.ajax({
          url: APP_URL+"/admin/chart_users_flow",
          dataType: "json",
          async: false
          }).responseText;

        var data = new google.visualization.DataTable(data);



        var options = {
          title: 'Number of registrations',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('line-chart'));

        chart.draw(data, options);
      }
});

@endsection

