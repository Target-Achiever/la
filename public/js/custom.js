$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//-----------------------------------------------ajax loader
// Binds to the global ajax scope 
$( "#la-ajaxloader" ).show();
$(document).ready(function(){

    $("#provider_aesthetic_services1").multiselect();
    //$("#provider_aesthetic_services").multiselect();
    //----------------------------------------------aesthetic services and combo services
    $("#combo_service_frm_submit").click(function(e)
    {
        $( "#la-ajaxloader" ).show();
        e.preventDefault();
        var combo = $("#provider_aesthetic_services").val();
        if(combo == ""){
            $( "#la-ajaxloader" ).hide();
            $('#error_comb').html('<p class="text-danger">Please enter the combination offers.</p>');
            return false;
        }
        $.ajax({
            type: 'POST',
            url: APP_URL+'/service_multiselect_ajax',
            data: {'aesthetic_combo_treatment' :combo},
            success: function(data){
                $( "#la-ajaxloader" ).hide();
                if(data.status)
                {

                    //---------------------------------
                    var $this = $("#provider_aesthetic_services");
                    if ($this.length) {
                        $("#error_combo").hide();
                        var toAppend = '<div class="combo combo_'+data.id+'">'+data.service+'<span class="remove_combo" data-combo="'+data.id+'">x</span></div>';

                        $("#multiple_select_show").append(toAppend);
                        $("#provider_aesthetic_services").val("");
                        $('#error_comb').html(" ");
                        $('.no-record').hide();
                    }else
                    {
                        $("#multiple_select_show").append('<p class="err-combo">'+data.message+'</p>');
                    }

                    //---------------------------------
                }
                else
                {
                    $("#error_combo").html('<p class="err-combo">'+data.message+'</p>');
                }
            }
        });        
    })

    $(document).on('click','.remove_combo',function()
    {
        var id = $(this).attr('data-combo');

        $.ajax({
            type: 'POST',
            url: APP_URL+'/remove_combo/'+id,
            data: id,
            success: function(data){

                if(data.status)
                {
                    $(".combo_"+data.id).hide();
                }
                else{

                    alert(data.message);
                }

            }

        });

    });
    //----------------------------------------------aesthetic services and combo services end

    window.setTimeout(function () {
        $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 5000);

});
$( document ).ajaxStart(function()
{
    // $( "#la-ajaxloader" ).show();
});
$( document ).ajaxComplete(function()
{
    // $( "#la-ajaxloader" ).hide();
});

//-----------------------------------------------
$('#feedbackForm').submit(function(e){

    e.preventDefault();
    $( "#la-ajaxloader" ).show();
    if($('#feedback_text').val() == ''){
        $( "#la-ajaxloader" ).hide();
        $('.feed_error').addClass('has-error');
        $('#feedback_text').focus();

        return false;
    }
    $.ajax({
        type: 'POST',
        url: APP_URL+'/feedback',
        data: $(this).serialize(),
        success: function(data){
            $('#no_review').hide();
            $( "#la-ajaxloader" ).hide();
            $('#feedbackForm')[0].reset();
            $('#feedback_message').prepend(data);
        },
        error: function(data){

        }
    });
});
$(document).on('click',"#update_profile",function()
{
    $("#user_update").submit();
});

$(document).on('click',"#submit",function()
{
    $("#save_become_a_provider").submit();
});

$(document).on('click',"#cancel",function()
{
    $("#user_update")[0].reset();
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#displayImage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function() {
    readURL(this);
});

$(".cancel_appointment").click(function(e){
    e.stopPropagation();
    var appointment = $(this).attr("data-app-id");

    swal({
            title: "Are you sure?",
            text: "Your appointment can be canceled.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, cancel it.",
            closeOnConfirm: false
        },
        function(){
            $.ajax({
                type:'GET',
                url:APP_URL+'/cancel_appointment/'+appointment,
                success:function(res){

                    if(res=="true")
                    {
                        swal("Success.", "Notification removed", "success");

                    }
                    else
                    {
                        swal("Oops.", message, "error");

                    }
                }
            });
        });
});

$(document).on('click','.app-cancel-btn',function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    swal({
            title: "Are you sure?",
            text: "Cancelled appointment will not be retrieved.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes, cancel it.",
            closeOnConfirm: false
        },
        function(){
            window.location.replace(url);
        });
});
//====================================================
//User Dashboard - Tabs
$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
    // e.preventDefault();
    $(this).siblings('a.active').removeClass("active");
    $(this).addClass("active");
    var index = $(this).index();
    $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
    $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
});
//--------------------
var response_data;

$(function () {
    $( "#la-ajaxloader" ).hide();//hide loader
    window.setTimeout(function () {
        $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 5000);
    //----------------------------------user registration
    //----------------------------------user registration
    $("#registerForm").validate({
           rules: {
                "name": {
                   required: true,
                   minlength: 5
               },
               "email": {
                   required: true,
                   email: true
               },
               "password": {
                   required: true,
                   minlength: 5
               },
               "password_confirmation": {
                   equalTo: "#password",
               }
           },
           messages: {
               "name": {
                   required: "Please enter the name"
               },
               "email": {
                   required: "Please enter an email",
                   email: "Email is invalid"
               },
               "password": {
                   required: "Please enter the password",
                   minlength: "Minimum length 5"
               },
               "password_confirmation": {
                   required: "Please enter the confirm password",
                   equalTo: "Password mismatch"
               }
           },
            submitHandler: function (form) 
            { 
                $( "#la-ajaxloader" ).show();
                $.ajax({

                        type: 'POST',
                        url: APP_URL+'/register',
                        data: $("#registerForm").serialize(),
                        dataType: 'json',
                        success: function(data){
                            if(data.status =='true') {
                                $( "#la-ajaxloader" ).hide();
                                $("#registerForm")[0].reset();
                                $("#registration-response").html('<div class="alert alert-success alert-white rounded"> ' +
                                    '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> ' +
                                    '<div class="icon"> <i class="fa fa-check"></i> </div>'+data.message+'</div>');
                                window.setTimeout(function () {
                                    $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
                                        $(this).remove();
                                    });
                                }, 5000);
                            }else{
                                $( "#la-ajaxloader" ).hide();
                                $("#registration-response").html('<div class="alert alert-danger alert-white rounded"> ' +
                                    '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> ' +
                                    '<div class="icon"> <i class="fa fa-times"></i> </div>'+data.message+'</div>');

                                window.setTimeout(function () {
                                    $(".alert-danger").fadeTo(500, 0).slideUp(500, function () {
                                        $(this).remove();
                                    });
                                }, 5000);
                            }

                        },
                        error: function(data){

                        }
                    });
            }
        });
    //--------------------------------------------------
    //-------------------------------------------------user login
    $("#loginForm").validate({
           rules: {
               "password": {
                   required: true,
                   minlength: 5
               },
               "email": {
                   required: true,
                   email: true
               }
           },
           messages: {
               "password": {
                   required: "Please enter the password"
               },
               "email": {
                   required: "Please enter an email",
                   email: "Email is invalid"
               }
           },
           submitHandler: function (form) { // for demo
               $.ajax({
               type: 'POST',
               url: APP_URL+'/custom-login',
               data: $('#loginForm').serialize(),
               dataType : 'json',
               success: function(data){

                   if(data.auth)
                   {
                       location.href = APP_URL+data.intended;
                   }
                   else
                   {
                       $("#login-response").show().html('<div class="alert alert-danger alert-white rounded notify_register"> ' +
                           '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> ' +
                           '<div class="icon"> <i class="fa fa-times"></i> </div>'+data.intended+'</div>');
                      // $("#login-response").text(data.intended);
                       //$("#login-response").show();
                   }
                   window.setTimeout(function () {
                       $(".alert-danger").fadeTo(500, 0).slideUp(500, function () {
                           $(this).remove();
                       });
                   }, 5000);
               },
               error: function(data){
                   console.log(data);
               }
            });
           }
       });
    //--------------------------------------------------

    var search_data = {
        'latitude' : '',
        'longitude' : '',
        'list' : '',
    };
    //=============================================google location - search page
    //--------------------date picker appointment page
    $('#preferred_date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: 'd',
        autoclose: true
    });

    //-------------------------------------------------load time slots
    $('.load-time-slots').datepicker().on('changeDate', function(ev) {
        var provider = $("#provider_id").val();
        var preferred_date = $("#preferred_date").val();
        var service = $("#service_needed").val();
        if((service == '') || (preferred_date == '')) {
            $('.error_message').text('Please select the services.');
            return false;
        }
        $('.error_message').text('');
        $.ajax({
            type:'GET',
            url:APP_URL+'/get_available_time_slots/'+preferred_date+'/'+service+'/'+provider,
            data : {'date' : 'a'},
            success:function(data){
                $("#check-load").html(data);
            }
        });

    });
    //=================================================
    //----------------------------------------------location detector

    $(".location_point").click(function(){  //detect click -ho,e page search

        var startPos;
        var detectlocation='';
        var geoSuccess = function(position) {
            startPos = position;
            var geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(startPos.coords.latitude, startPos.coords.longitude);
            geocoder.geocode({'latLng': latlng}, function(results, status) {

                for (var i=0; i<results[0].address_components.length; i++)
                {
                    for (var b=0;b<results[0].address_components[i].types.length;b++)
                    {

                        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                        if (results[0].address_components[i].types[b] == "administrative_area_level_2")
                        {
                            //this is the object you are looking for
                            city= results[0].address_components[i];
                            detectlocation += city.long_name;
                            break;
                        }
                        if (results[0].address_components[i].types[b] == "administrative_area_level_1")
                        {
                            //this is the object you are looking for
                            state = results[0].address_components[i];//state
                            detectlocation += (typeof(city.long_name)!='undefined' && city.long_name!=null) ? ', '+state.long_name : state.long_name;
                            break;
                        }
                        if (results[0].address_components[i].types[b] == "country")
                        {
                            //this is the object you are looking for
                            country= results[0].address_components[i];
                            detectlocation += (typeof(state.long_name) != 'undefined' && state.long_name!=null) ? ', '+country.long_name : country.long_name;
                            break;
                        }
                    }
                }
                //city data
                // var detectlocation = city.long_name+', '+state.long_name+', '+country.long_name;
                $("#search_location").val(detectlocation);
                //-----------------
                search_data.latitude = startPos.coords.latitude;
                search_data.longitude = startPos.coords.longitude;

                //---------------------------------set search form hidden value
                $('input[name="latitude"]').val(search_data.latitude);
                $('input[name="longitude"]').val(search_data.longitude);

                var toAppend='';
                //----------------------------------
                $.ajax({
                    type:'POST',
                    url:APP_URL+'/list-providers-services',
                    data : {'searchKey' : detectlocation,'lat' : search_data.latitude,'lon' : search_data.longitude},
                    success:function(res){
                        $(".search-results").fadeIn(200);
                        //--------------------loop
                        if(res.length != 0)
                        {
                            $.each(res, function(i, v)
                            {

                                // toAppend += '<option>'+v.service+'</option>';
                                toAppend += '<div class="list-item" data-service="'+v.service+'"><i class="fa fa-search"></i>'+v.service+'</div>';


                            });
                            toAppend += '<div class="list-item" data-service="offers&deals"><i class="fa fa-search"></i>Offers & deals</div>';
                        }else
                        {
                            // toAppend = '<option>No Results Found</option>';
                            toAppend += '<div class="list-item">No Results Found</div>';
                        }
                        $('#providers-list').html(toAppend);

                        //------------------------
                    }
                });
                //--------------------
            });
        };
        var asdf = navigator.geolocation.getCurrentPosition(geoSuccess);


    });

    // location detector end here
    //----------------------------------------------------------------place change

    google.maps.event.addDomListener(window, 'load', function () {

        var locations = new google.maps.places.Autocomplete(document.getElementById('search_location'));

        google.maps.event.addListener(locations, 'place_changed', function () {

            var results = locations.getPlace();

            var address = results.formatted_address;
            var latitude = results.geometry.location.lat();
            var longitude = results.geometry.location.lng();


            var mesg = "Address: " + address;
            mesg += "\nLatitude: " + latitude;
            mesg += "\nLongitude: " + longitude;

            search_data.latitude = latitude;
            search_data.longitude = longitude;

            //---------------------------------set search form hidden value
            $('input[name="latitude"]').val(search_data.latitude);
            $('input[name="longitude"]').val(search_data.longitude);
            //----------------------------------

            var toAppend='';
            //----------------------------------
            $.ajax({
                type:'POST',
                url:APP_URL+'/list-providers-services',
                data : {'searchKey' : address,'lat' : search_data.latitude,'lon' : search_data.longitude},
                success:function(res){
                    $(".search-results").fadeIn(200);
                    //--------------------loop
                    if(res.length != 0)
                    {
                        $.each(res, function(i, v)
                        {

                            // toAppend += '<option>'+v.service+'</option>';
                            toAppend += '<div class="list-item" data-service="'+v.service+'"><i class="fa fa-search"></i>'+v.service+'</div>';

                        });
                        toAppend += '<div class="list-item" data-service="offers&deals"><i class="fa fa-search"></i>Offers & deals</div>';
                    }else
                    {
                        // toAppend = '<option>No Results Found</option>';
                        toAppend += '<div class="list-item">No Results Found</div>';
                    }
                    $('#providers-list').html(toAppend);

                    //------------------------
                }
            });
            //--------------------


        });

        //-------------------------------------------------user account- profile address

        var places = new google.maps.places.Autocomplete(document.getElementById('user_address'));

        google.maps.event.addListener(places, 'place_changed', function () {

            var results = places.getPlace();
            // var address = results.formatted_address;

            var detectlocation='';
            var detectlocationcountry = detectlocationstate = detectlocationcity = '';
            //------------------------------------------------------------------get country,state,city
            for (var i=0; i<results.address_components.length; i++)
            {
                for (var b=0;b<results.address_components[i].types.length;b++)
                {

                    //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                    if (results.address_components[i].types[b] == "administrative_area_level_2")
                    {
                        //this is the object you are looking for
                        city= results.address_components[i];

                        detectlocationcity += city.long_name;
                        break;
                    }
                    if (results.address_components[i].types[b] == "administrative_area_level_1")
                    {
                        //this is the object you are looking for
                        state = results.address_components[i];//state
                        detectlocationstate = state.long_name;
                        break;
                    }
                    if (results.address_components[i].types[b] == "country")
                    {
                        //this is the object you are looking for
                        country= results.address_components[i];
                        detectlocationcountry = country.long_name;
                        break;
                    }
                }
            }

            //----------------------------------append coutry, state ,city value

            $('input[name="user_city"]').val(detectlocationcity);
            $('input[name="user_state"]').val(detectlocationstate);
            $('input[name="user_country"]').val(detectlocationcountry);

            ////end

        });

        //-------------------------------------------------------------------------
    });

    //---------------------------------- place change end
    $(document).on('click',".list-item",function()
    {
        var service = $(this).attr('data-service');
        $("#providers-list-input").val(service);
        $("#search-services-form").submit();
    });

    $("#providers-list-input").keyup('input',function()//key up in providers list input next to location search
    {

        var searchKey = $(this).val();

        var searchLocation = $("#search_location").val();

        if(typeof(search_data) != "undefined" && search_data !== null) {

            search_data.latitude = $("#latitude").val();
            search_data.longitude = $("#longitude").val();

        }

        var toAppend = '';
        $.ajax({
            type:'POST',
            url:APP_URL+'/get-search-result',
            data : {'location' : searchLocation,'searchKey' : searchKey,'lat' : search_data.latitude,'lon' : search_data.longitude,'type' : 'keyup'},
            success:function(res){
                $(".search-results").fadeIn(200);
                //-------------------------------
                console.log(res);


                if(res != '')
                {
                    $.each(res, function(i, v)
                    {
                        
                        if(v.service !=null)
                        {
                            
                            toAppend += '<div class="list-item" data-service="'+v.service+'"><i class="fa fa-search"></i>'+v.service+'<span class="specialist-name">'+v.name+'</span></div>';
                        }
                        else
                        {
                            
                            toAppend += '<div class="list-item"><i class="fa fa-search"></i>no data found</div>';
                        }


                    });
                    toAppend += '<div class="list-item" data-service="offers&deals"><i class="fa fa-search"></i>Offers & deals</div>';
                }else
                {
                    toAppend += '<div class="list-item"><i class="fa fa-search"></i>no data found</div>';
                }

                $('#providers-list').html(toAppend);

            }
        });

    });
    //------------------------input click
    $("#providers-list-input").click('input',function()//click providers list input next to location search
    {
        var searchKey = $(this).val();

        var searchLocation = $("#search_location").val();

        if(typeof(search_data) != "undefined" && search_data !== null) {

            search_data.latitude = $("#latitude").val();
            search_data.longitude = $("#longitude").val();

        }

        var toAppend = '';
        $.ajax({
            type:'POST',
            url:APP_URL+'/get-search-result',
            data : {'location' : searchLocation,'searchKey' : searchKey,'lat' : search_data.latitude,'lon' : search_data.longitude,'type' : 'focus'},
            success:function(res){
                $(".search-results").fadeIn(200);
                //-------------------------------
                if(res != '')
                {
                    $.each(res, function(i, v)
                    {
                        
                        if(v.service !=null)
                        {
                            
                            toAppend += '<div class="list-item" data-service="'+v.service+'"><i class="fa fa-search"></i>'+v.service+'</div>';
                        }
                        else
                        {
                            
                            toAppend += '<div class="list-item"><i class="fa fa-search"></i>no data found</div>';
                        }


                    });
                    toAppend += '<div class="list-item" data-service="offers&deals"><i class="fa fa-search"></i>Offers & deals</div>';
                }else
                {
                    toAppend += '<div class="list-item"><i class="fa fa-search"></i>no data found</div>';
                }

                $('#providers-list').html(toAppend);

            }
        });
    });
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
    //--------------------------------------

    $(".book_appoint").click(function(){
        var app_id = $(this).attr("data-appid");
        $.ajax({
            type:'POST',
            url:APP_URL+'/set-appointment-id',
            data : {'app_id' : app_id},
            success:function(res){

                response_data =  res;
                return response_data;
            }
        });
    })



    $(document).on('click','.time', function()
    {
        $(".time").removeClass('background');
        $(this).addClass('background');
    });
    //-------------------------------------------------my-appointment menu function

    $(".my-appointment").click(function(){

        var user = $(this).attr("data-user");
        $.ajax({
            type:'GET',
            url:APP_URL+'/get-appointment-list/'+user,
            success:function(res){

                $("#dynamicContentLoad .modal-body").html(res);
                $("#dynamicContentLoad").modal();
            }
        });

    });

    $(".service_content").click(function(){

        var type = 'services';
        var service_id = $(this).attr("data-service-id");
        $.ajax({
            type:'GET',
            url:APP_URL+'/load_modal/'+type,
            data:{'service_id' : service_id},
            success:function(res){
                $("#dynamicContentLoad .modal-body").html(res);
                $("#dynamicContentLoad").modal();
            }
        });

    });
    $(".service_content_read").click(function(){

        var type = 'services_read';
        $.ajax({
            type:'GET',
            url:APP_URL+'/load_modal/'+type,
            success:function(res){
                $("#dynamicContentLoad .modal-body").html(res);
                $("#dynamicContentLoad").modal();
            }
        });

    });

    $(".about_content").click(function(){

        var about = $(this).attr("data-about");
        var type = 'about'

        $.ajax({
            type:'GET',
            url:APP_URL+'/load_modal/'+type,
            data:{ 'id' : about},
            success:function(res){
                $("#dynamicContentLoad .modal-body").html(res);
                $("#dynamicContentLoad").modal();
            }
        });

    });
    // $(".blog_content").click(function(){

    //     var blog_type = $(this).attr("data-blog");
    //     var type = 'blog'

    //     $.ajax({
    //          type:'GET',
    //          url:APP_URL+'/load_modal/'+type,
    //          data:{ 'blog_type' : blog_type},
    //          success:function(res){
    //               $("#dynamicContentLoad .modal-body").html(res);
    //               $("#dynamicContentLoad").modal();
    //          }
    //       });

    // });

    //---------------------------------------------------------user nitification
    $(".notification_bar").click(function()
    {

        var noti_id = $(this).attr('data-noti-id');
        var noti_type = $(this).attr('data-noti-type');
        $.ajax({
            type:'GET',
            url:APP_URL+'/notification_ajax/'+noti_id+'/'+noti_type,
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });
    });



    //--------------------------remove notificaiton
    $(".remove-notification").click(function(e)
    {
        e.stopPropagation();
        var notiId = $(this).attr("data-noti-id");

        swal({
                title: "Are you sure?",
                text: "The updated info cannot ne changed.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it.",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    type:'GET',
                    url:APP_URL+'/remove_notification/'+notiId,
                    success:function(res){
                        if(res.status=="true")
                        {
                            // swal("Success.", "Notification removed", "success");
                            swal.close();
                            $("#notification_box_"+notiId).remove();
                        }
                        else
                        {
                            swal("Oops.", res.message, "error");

                        }
                    }
                });
            });
    });
    //-----------------------------------user account page
    //-----------------------------------Service Load More
    $('.load-more').click(function()
    {
        var div = $(".load-more");
        $('.more-list').toggle('slow', function() { if ($(this).is(':visible')) { div.text('Hide'); } else { div.text('More Services'); } });

    });
    //-----------------------------------Gallery
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
    //-----------------------------------Ads Thumbnail
    $('#Carousel').carousel({
        interval: 5000,
        cycle: true
    })
    //-----------------------------------Service Thumbnail
    $('#Carousel1').carousel({
        interval: 5000,
        cycle: true
    })
   //-----------------------------------Service Mob Thumbnail
    $('#Carousel2').carousel({
        interval: 5000,
        cycle: true
    })
   //-----------------------------------Ads Mob Thumbnail
    $('#Carousel3').carousel({
        interval: 5000,
        cycle: true
    })
    //============================================
    //-----------------------------------Step Forms Wizard
    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn'),
        allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='radio'],input[type='checkbox'],select"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
                $(curInputs[i]).closest().addClass("has-error");
            }
        }
        if($("input[name='aesthetic_training']:checked").val() == 'N'){
            return false;
        }
        $("html, body").animate({ scrollTop: 0 }, "slow");
        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });
    allPrevBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div #'+curStepBtn).hide().prev().show();
        $("html, body").animate({ scrollTop: 0 }, "slow");

    });
    $('div.setup-panel div a.btn-success').trigger('click');
});
//*----------------------------*Custom upload//
$("#photo").change(function(){
    $("#photo-name").text(this.files[0].name);
});

$("#other_certificate").change(function(){
    $("#other_certificate-name").text(this.files[0].name);
});
$("#identity").change(function(){
    $("#identity-name").text(this.files[0].name);
});

$("#address_proof").change(function(){
    $("#address_proof-name").text(this.files[0].name);
});
$("#medical_qualification").change(function(){
    $("#medical_qualification-name").text(this.files[0].name);
});

$("#rights_prescribe").change(function(){
    $("#rights_prescribe-name").text(this.files[0].name);
});
$("#aesthetic_training_certificate").change(function(){
    $("#aesthetic_training_certificate-name").text(this.files[0].name);
});
$("#insurance_certificate").change(function(){
    $("#insurance_certificate-name").text(this.files[0].name);
});
//**--Auto Complete With Tags

var countries = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
        url: APP_URL+'/services_list',
        filter: function(list) {
            return $.map(list, function(name) {
                return { name: name }; });
        }
    }
});
countries.initialize();

$('#tags-input').tagsinput({
    typeaheadjs: {
        name: 'countries',
        displayKey: 'name',
        valueKey: 'name',
        source: countries.ttAdapter()
    }
});

$('input[type=radio][name="uk"]').change(function () {
    if($("input[name='uk']:checked").val() == 'N'){
        $('input[type=text][name="other_uk"]').show();
        $('input[type=text][name="other_uk"]').attr('required','required');
    }else{
        $('input[type=text][name="other_uk"]').hide();
        $('input[type=text][name="other_uk"]').removeAttr('required','required');

    }

});
$('input[type=radio][name="uk_qualification"]').change(function () {
    if($("input[name='uk_qualification']:checked").val() == 'N'){
        $('input[type=text][name="other_uk_qualification"]').show();
        $('input[type=text][name="other_uk_qualification"]').attr('required','required');
    }else{
        $('input[type=text][name="other_uk_qualification"]').hide();
        $('input[type=text][name="other_uk_qualification"]').removeAttr('required','required');
    }

});

$('input[type=radio][name="aesthetic_training"]').change(function () {
    if($("input[name='aesthetic_training']:checked").val() == 'N'){
        $('.aesthetic_training_not').hide();
        $('input[type=text][name="aesthetic_training_date"]').removeAttr('required','required');
    }else{
        $('input[type=text][name="other_aesthetic_training"]').hide();
        $('input[type=text][name="other_aesthetic_training"]').removeAttr('required','required');
        $('.aesthetic_training_not').show();
        $('input[type=text][name="aesthetic_training_date"]').attr('required','required');
    }

});

$('input[type=radio][name="refund"]').change(function () {
    if($("input[name='refund']:checked").val() == '1'){
        $('#refund_days').show();
        $('.refunds').attr('required');

    }else{
        $('#refund_days').hide();
        $('.refunds').prop('selectedIndex',0);
        $('.refunds').removeAttr('required');


    }

});

$('.prescribing_rights').on('change', function() {
    if($(this).find(":selected").val() =='others'){
        $('.other_prescribing_rights').show();
        $('input[type=text][name="other_prescribing_rights"]').attr('required','required');
    }else {
        $('.other_prescribing_rights').hide();
        $('input[type=text][name="other_prescribing_rights"]').removeAttr('required','required');
    }
});

$('.professional').on('change', function() {
    if($(this).find(":selected").val() =='Others (please specify)'){
        $('.other_professional').show();
        $('input[type=text][name="other_professional"]').attr('required','required');
    }else {
        $('.other_professional').hide();
        $('input[type=text][name="other_professional"]').removeAttr('required','required');
    }
});
$(".Subscribe").click(function(e){

    var email = $('input[type=text][name="subscribe_email"]').val();
    if( email == ""){
        $('.sub_scribe').addClass('has-error');
        $('input[type=text][name="subscribe_email"]').focus();
        return false;
    }else{
        if(isEmail(email) == false) {

            $('.sub_scribe').addClass('has-error');
            $('input[type=text][name="subscribe_email"]').focus();
            return false;
        }
        else {
            $("#Subscribe").submit();
        }
    }

});

function isEmail(email) {

    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    return regex.test(email);
}

$('.professional_pin').on('change', function() {
    if($(this).find(":selected").val() =='others'){
        $('.other_professional_pin').show();
        $('input[type=text][name="other_professional_pin"]').attr('required','required');
    }else {
        $('.other_professional_pin').hide();
        $('input[type=text][name="other_professional_pin"]').removeAttr('required','required');
    }
});

$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },

    boundary: {
        width: 250,
        height: 250
    }

});

$('#photo').on('change', function () {
    $('#blah').hide();
    $('.upload-demo').show();
    $('#nextBtn').attr('data-type','provider_profile')
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});


$("#nextBtn").click(function() {
    

        //---------------------------------------------
        var f1 = $("#identity");
        var f2 = $("#address_proof");
        var f3 = $("#medical_qualification");
        var f4 = $("#rights_prescribe");//not required
        var f5 = $("#aesthetic_training_certificate");
        var f6 = $("#insurance_certificate");
        var f7 = $("#other_certificate");//not required


        var form_edit = $("#become_a_prvider_edit").val()

        var success = true;
        if(form_edit == '0')
        {

                if (f1.get(0).files.length === 0) {
                    
                    $(".error1").css('border','1px solid red');
                    success = false;
                }
                else
                {
                    $(".error1").attr('style','');
                }
                if (f2.get(0).files.length === 0) {
                    
                    $(".error2").css('border','1px solid red');
                    success = false;
                }
                else
                {
                    $(".error2").attr('style','');
                }
                if (f3.get(0).files.length === 0) {
                    
                    $(".error3").css('border','1px solid red');
                    success = false;
                }
                else
                {
                    $(".error3").attr('style','');
                }
                if (f5.get(0).files.length === 0) {
                    
                    $(".error5").css('border','1px solid red');
                    success = false;
                }
                else
                {
                    $(".error5").attr('style','');
                }
                if (f6.get(0).files.length === 0) {
                    
                    $(".error6").css('border','1px solid red');
                    success = false;
                    
                }
                else
                {
                    $(".error6").attr('style','');
                }
        }

        if ($("input[name='declaration']:checked").val() == '1') 
        {
            $(".declaration").attr('style','');
        } else {
        
                success = false;
                $('#declaration').attr('required','required');
                $(".declaration").css('outline','1px solid #a94442');
        
        }

        if(!success)
        {
            return false;
        }
       //-----------------------------------------------------
        var type = $("#nextBtn").attr("data-type");
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            $('#profileimg').attr('src', resp).show();
            $('.upload-demo').hide();
            $('#provider_profile').val(resp);
            $( "#la-ajaxloader" ).show();
            $("#save_become_a_provider").submit();

        });
});

$(document).ready(function(){
    $('.provider_dob').on('change',function () {
        var from = $('#date').val().split("/"); // DD/MM/YYYY
        var day = from[0];
        var month = from[1];
        var year = from[2];
        var age = 18;
        var mydate = new Date();
        mydate.setFullYear(year, month-1, day);
        var currdate = new Date();
        var setDate = new Date();

        setDate.setFullYear(mydate.getFullYear() + age, month-1, day);

        if ((currdate - setDate) > 0){
            $('.error_dob').removeClass('has-error');
            $('.error-message').html("").removeClass('text-danger');
            return true;
        }else{
            $('.error_dob').addClass('has-error');
            $('.error-message').html("Sorry, you must be 18 years of age to apply").addClass('text-danger');
            $('#date').val("");
            return false;
        }
    });
    //-------------------------------------ajax search result
    $("#load_more_feedback").on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var type = $(this).data('type');
        var provider_id = "";
        if(type == 'provider_overview'){
            provider_id = $('#provider_id').val();
        }
        $("#load_more_feedback").html("Loading....");
        $.ajax({
            url: APP_URL + '/load_more_feedback',
            method: "POST",
            data: {id: id,type:type,provider_id:provider_id},
            dataType: "text",
            success: function (data) {
                if (data != '') {
                    $('#remove-row').remove();
                    $('#load-data').append(data);
                }
                else {
                    $('#load_more_feedback').html("No Data");
                }
            }
        });
    });

    $("#ajax_search_load_more").click(function()
    {

                var string = $(this).attr('data-queryString');
                var id = $(this).attr('data-id');

                var offset = parseInt(id) + 1;

                $(this).attr('data-id',offset);

                $.ajax({
                    type:'POST',
                    url:APP_URL+'/ajax_search',
                    data : {'queryString' : string,'offset' : offset},
                    success:function(res){
                        if(res)
                        {
                            $("#search-result-for").append(res);
                            
                        }else
                        {
                            $(".no-data-found").show();
                        }
                    }
                });
    });
});