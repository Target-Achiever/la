$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//====================================================

var response_data;

$(function () {

                var search_data = {
                                    'latitude' : '',
                                    'longitude' : '',
                                    'list' : '',
                };
          //=============================================google location - search page


      $("#search-location").keyup(function(){
        $('#providers-list').html('<option>no records found</option>');//reset the services input
      })    
      
      var defaultBounds = new google.maps.LatLngBounds(
          new google.maps.LatLng(48.8191509,2.096455),
          new google.maps.LatLng(48.9410226,2.644932)
          );


        google.maps.event.addDomListener(window, 'load', function () {
            var options = {
                // componentRestrictions: {
                //  country: 'fr'
                // }
            };
        

            var places = new google.maps.places.Autocomplete(document.getElementById('search-location'),options);
            
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;

                search_data.latitude = latitude;
                search_data.longitude = longitude;
                console.log(latitude+"***"+longitude);
                //---------------------------------set search form hidden value
                $('input[name="latitude"]').val(search_data.latitude);
                $('input[name="longitude"]').val(search_data.longitude);
                //----------------------------------

                      var toAppend = '';
                      var listStatus = false;
                      var parseJson = JSON.parse(response_data);
                      $('#providers-list').html('');
                      $.each(parseJson, function(i, v) {
                          if (v.latitude == search_data.latitude && v.longitude == search_data.longitude) {
                    
                              $.each(v.providers_services,function(i,v){
                                  
                                    listStatus = true; 
                                    toAppend += '<option>'+v.service+'</option>';
                                });
                          
                              
                          }
                          
                    
                    
                      });   

                      if(!listStatus)
                      {
                        toAppend = '<option>no records fount</option>';
                      }                  
                      
                      $('#providers-list').append(toAppend);
                      $('#providers-list').trigger('open');

            });
        });    


        $("#providers-list-input").change('input',function()
        {

            $("#search-services-form").submit();
        })
        //=======================================load provider services on load

        $(document).ready(function()
        {
          $.ajax({
               type:'POST',
               url:'/get-provider-services',
               data : {'action' : 'get_provoders_services'},
               success:function(res){
                  
                  response_data =  res;
                  return response_data;
               }
            });
        })


        //------------------------------------------home search pagination script

        $(document).on('click', '.pagination a',function(event)
      {
       
           event.preventDefault();
           var page=$(this).attr('href').split('page=')[1];
           
          
           if(window.location.href.indexOf("?") > -1) {
            
                var url = document.location.href;
                urla = url.substr(0, url.indexOf('page=')); 
                if(urla =='')
                {

                  url = url+"&page="+page;
                }
                else
                {
                  
                  url = urla+"page="+page;
                }
                  
            }else{

                var url = document.location.href;
                url = url.substr(0, url.indexOf('?page=')); 
                url = document.location.href+"?page="+page;
            }

              document.location = url;
          
      });
    //============================================  
  });