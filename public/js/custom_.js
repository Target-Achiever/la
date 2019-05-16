$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//====================================================

$(function () {

           //Initialize Select2 Elements
           $('.select2').select2()
         
           //Datemask dd/mm/yyyy
           $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
           //Datemask2 mm/dd/yyyy
           $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
           //Money Euro
           $('[data-mask]').inputmask()
         
           //Date range picker
           $('#reservation').daterangepicker()
           //Date range picker with time picker
           $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
           //Date range as a button
           $('#daterange-btn').daterangepicker(
             {
               ranges   : {
                 'Today'       : [moment(), moment()],
                 'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                 'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                 'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                 'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
               },
               startDate: moment().subtract(29, 'days'),
               endDate  : moment()
             },
             function (start, end) {
               $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
             }
           )
         
           //Date picker
           $('#datepicker').datepicker({
             autoclose: true
           })
         
           //iCheck for checkbox and radio inputs
           $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
             checkboxClass: 'icheckbox_minimal-blue',
             radioClass   : 'iradio_minimal-blue'
           })
           //Red color scheme for iCheck
           $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
             checkboxClass: 'icheckbox_minimal-red',
             radioClass   : 'iradio_minimal-red'
           })
           //Flat red color scheme for iCheck
           $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
             checkboxClass: 'icheckbox_flat-green',
             radioClass   : 'iradio_flat-green'
           })
         
           //Colorpicker
           $('.my-colorpicker1').colorpicker()
           //color picker with addon
           $('.my-colorpicker2').colorpicker()
         
           //Timepicker
           $('.timepicker').timepicker({
             showInputs: false
           })
         })
    
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : '#61bce2',
          strokeColor         : '#61bce2',
          pointColor          : '#61bce2',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [0, 22, 15, 27, 20, 25, 30]
        },
        {
          label               : 'Digital Goods',
          fillColor           : '#fb7b5f',
          strokeColor         : '#fb7b5f',
          pointColor          : '#3b8bba',
          pointStrokeColor    : '#fb7b5f',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [10, 5, 20, 15,35,25,12]
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
  })

  $(function () 
  {
      
      $(".destroy-element").click(function()
      {
        var form_id = $(this).attr("data-service");
        swal({
                title: "Are you sure?",
                text: "This data will be delete permanently.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm){
                if (isConfirm) {
                  $("#delete-form-"+form_id).submit();        // submitting the form when user press yes
                } else {
                  swal("Cancelled", "Your data is safe :)", "error");
                }
              });
      });
     //========================================= 
          var count=0;
          function handleFileSelect(evt) {
            var $fileUpload = $("input#files[type='file']");
            count=count+parseInt($fileUpload.get(0).files.length);

            if (parseInt($fileUpload.get(0).files.length) > 6 || count>5) {
              alert("You can only upload a maximum of 5 files");
              count=count-parseInt($fileUpload.get(0).files.length);
              evt.preventDefault();
              evt.stopPropagation();
              return false;
            }

            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++) {
              if (!f.type.match('image.*')) {
                continue;
              }

              var reader = new FileReader();

              reader.onload = (function (theFile) {
                return function (e) {
                  var span = document.createElement('span');
                  span.innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', escape(theFile.name), '"/><span class="remove_img_preview"><i class="fa fa-times-circle"></i></span>'].join('');
                  document.getElementById('list').innerHTML = '';
                  document.getElementById('list').insertBefore(span, null);
                };
              })(f);

              reader.readAsDataURL(f);
            }
          }
          //----------------------
          $('#files').change(function(evt){
            handleFileSelect(evt);
          });  
          //----------------------
          $('#list').on('click', '.remove_img_preview',function () 
            {
              $(this).parent('span').remove();
                $("input#files[type='file']").val("");  
                  count--;
            });

          //---------------------------------
      

    //============================================  
  });