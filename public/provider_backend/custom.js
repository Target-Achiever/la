$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//====================================================
$( document ).ajaxStart(function()
{
     $( "#la-ajaxloader" ).show();
});
$( document ).ajaxComplete(function()
{
     $( "#la-ajaxloader" ).hide();
});

$(function() {
    // $('#value_format_maker_amount').maskMoney();
    $('#value_format_maker_pre_amount').maskMoney({thousands:''});
    // $('#value_format_maker_presamount').maskMoney({thousands:''});
    //-----------------------------------------------------------
    $("#value_format_maker_amount").blur(function(){

          var value = $(this).val();

          if(value <= 100 )
          {
            $("#error-less-100").text('Amount must be more than 100');
          }

      });

      $("#value_format_maker_presamount").blur(function(){

          var value = $(this).val();

          if(value <= 30 )
          {
            $("#error-less-30").text('Amount must be more than 30');
          }

      });
});
//-----------------------------------------------chart
$( "#la-ajaxloader" ).hide();
window.setTimeout(function () {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
    $(".alert-warning").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
    $(".alert-danger").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 5000);

//--------------------------------------------------------------
//---------------------------------------------tooltip
$('[data-toggle="tooltip"]').tooltip();
//---------------------------------------------end
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
                confirmButtonText: "Yes, delete it.",
                cancelButtonText: "No, cancel please.",
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

    // $(".notification_bar").click(function()
    // {

    //         var noti_id = $(this).attr('data-noti-id');
    //         var noti_type = $(this).attr('data-noti-type');
    //         $.ajax({
    //                  type:'POST',
    //                  url:APP_URL+'/provider/notification_ajax',
    //                  data : {'noti_id' : noti_id,'noti_type' : noti_type},
    //                  success:function(data){
    //                     $(".modal-body").html(data);
    //                     $("#modal-default").modal();
    //                  }
    //               });
    // });

    $(".notification_bar").click(function()
    {

        var noti_id = $(this).attr('data-noti-id');
        var noti_type = $(this).attr('data-noti-type');
        $.ajax({
            type:'GET',
            url:APP_URL+'/provider/notification_ajax/'+noti_id+'/'+noti_type,
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
                $("#notification_box_"+noti_id).removeClass('alert-info').addClass('alert-default');
            }
        });
    });

    $(document).on('click','.change_accept_status',function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, proceed",
                closeOnConfirm: false
            },
            function(){
                window.location.replace(url);
            });
    });

    $(document).on('click','.change_decline_status',function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
                title: "Are you sure?",
                text: "The decline info cannot be changed.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, decline it.",
                closeOnConfirm: false
            },
            function(){
                window.location.replace(url);
            });
    });


    //--------------------------remove notificaiton
    $(".remove-notification").click(function(e)
    {
        e.stopPropagation();
        var notiId = $(this).attr("data-noti-id");

        swal({
                title: "Are you sure you want to remove?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Remove it.",
                closeOnConfirm: false,
            },
            function(){
                $.ajax({
                    type:'GET',
                    url:APP_URL+'/provider/remove_notification/'+notiId,
                    success:function(res){
                        if(res.status=="true")
                        {
                            // swal("Success.", "Notification removed", "success");
                            swal.close();
                            $("#notification_box_"+notiId).remove();
                        }
                        else
                        {
                            swal("Oops.", "Somethinng went wrong.", "error");

                        }
                    }
                });
            });
    });

    //appoinment history page
    $('.services_avail').hunterTimePicker({
        callback: function(e){
            // alert(e.val());
        }
    });
    $("#checkAll").click(function () {
        $('#save_settings_frm input:checkbox').not(this).prop('checked', this.checked);
    })

    $(".appointment_view").click(function(){

        var appid = $(this).attr('data-app-id');
        $.ajax({
            type:'GET',
            url:APP_URL+'/provider/appointment_view/'+appid,
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });

    });
    //----------------------------------------------  prescription services

    $(".set-service-availability").change(function()
    {
        var set = '2';
        if($(".set-service-availability").prop('checked') == true){
            set = '1';
        }

        var provider = $(this).attr('data-provider');
        $.ajax({
            type:'GET',
            url:APP_URL+'/provider/set_service_availability/'+set+'/'+provider,
            success:function(data){
                if(data)
                {
                    $(".set-updated").html('<div class="alert alert-success alert-white rounded notify"> ' +
                        '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> ' +
                        '<div class="icon"> <i class="fa fa-check"></i>' +
                        ' </div>Setting updated</div>');
                    //$(".set-updated").text("");
                }else
                {
                    $(".set-updated").html('<div class="alert alert-danger alert-white rounded notify"> ' +
                        '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> ' +
                        '<div class="icon"> <i class="fa fa-times"></i>' +
                        ' </div>Something went wrong</div>');

                }
                $(".set-updated").show();
            }
        });
    });


    //--------------------date picker provider prescription services page
    $('#preferred_date').datepicker({
        format: 'yyyy-mm-dd',
        startDate: 'd',
        autoclose: true
    });

    //-------------------------------------------------load time slots
    $(".load-time-slots").change(function () {


        var provider = $("#provider_id").val();
        var preferred_date = $("#preferred_date").val();
        var service = $("#service_needed").val();

        if((service == '') || (preferred_date == ''))

            return false;

        $.ajax({
            type:'GET',
            url:APP_URL+'/get_available_time_slots/'+preferred_date+'/'+service+'/'+provider,
            data : {'date' : 'a'},
            success:function(data){
                $("#check-load").html(data);
            }
        });

    });


    $(".time-slots").change(function (e) {

        var preferred_date=$(this).val();
        var time_slot=$('#time_slot').val();
        $.ajax({
            type:'POST',
            url:APP_URL+'/provider/advertisement/get_available_time_slot',
            data : {'date' : preferred_date,'time_slot' : time_slot },
            success:function(data){
                if(data){
                    $('.time-slots').val("");
                    $('.not_available').html("<p>"+data+"</p>");
                }
                else {
                    $('.not_available').html("");
                }
            }
        });

    });

    //------------calculate ad amount
      $("#time_slot").change(function()
      {
              var service = $("#ad_service").val();
              var offer = $("#ad_offer_percentage").val();
              if(service == '')
              {
                return false;
              }
              var duration  = $(this).val();
              $.ajax({
              type:'post',
              url:APP_URL+'/provider/advertisement_amount',
              data : {'duration' : duration ,'offer' : offer},
              success:function(data){
                  if(data.status==false){
                      $('#admin_amount_status').hide();
                  }
                      $(".ad_price").html(data.message);
              }
          });
      });
      $("#ad_offer_percentage").blur(function()
      {
              var service = $("#ad_service").val();
              var offer = $("#ad_offer_percentage").val();
              if(service == '')
              {
                return false;
              }
              var duration  = $("#time_slot").val();
              $.ajax({
              type:'post',
              url:APP_URL+'/provider/advertisement_amount',
              data : {'duration' : duration ,'offer' : offer},
              success:function(data){

                      $(".ad_price").html(data.message);
              }
          });
      });

      //-----ad offer

      $('#ad_offer').click(function()
      {

          var service = $("#ad_service").val();

          if(service == '')
          {
            swal("Oops.", 'Please choose service', "error");

            return false;
          }

          if($(this).prop("checked") == true){
              $( "#la-ajaxloader" ).show();
              $.ajax({
                   type:'POST',
                   url:APP_URL+'/provider/check_service_offer',
                   data : {'service' : service},
                   success:function(data){
                       $( "#la-ajaxloader" ).hide();

                      if(!data)
                      {
                        swal("Oops.", 'This service already in offer mode. So please choose another service to give offer.', "error");
                        $(".off_percentage").hide();
                      }
                      else
                      {

                        $(".off_percentage").show();
                      }
                   }
                });

          }
          else
          {
            $(".off_percentage").hide();
          }

      });

      $('#ad_service').change(function()
      {


          var service = $(this).val();

          if(service == '')
          {
            swal("Oops.", 'Please choose service', "error");

            return false;
          }

          if($("#ad_offer").prop("checked") == true){
              $( "#la-ajaxloader" ).show();
                $.ajax({
                   type:'POST',
                   url:APP_URL+'/provider/check_service_offer',
                   data : {'service' : service},
                   success:function(data){
                       $( "#la-ajaxloader" ).hide();

                      if(!data)
                      {
                        swal("Oops.", 'This service already in offer mode. So please choose another service to give offer.', "error");
                        $(".off_percentage").hide();
                      }
                      else
                      {

                        $(".off_percentage").show();
                      }
                   }
                });

          }
          else
          {
            $(".off_percentage").hide();
          }

      });
      //-----------end

    $(document).on('click','.time', function()
    {
        $(".time").removeClass('background');
        $(this).addClass('background');
    });

    //====================================notification clicked
    //============================================


    $('#example1').DataTable();

    var options={
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
        startDate: "+0d",
    };

    $('#period_from').datepicker(options);

    //-----------------------------bank-accoun page


    $(".remove_bank_account").click(function(e)
    {
        e.preventDefault();

        var url = $(this).attr("href");
        swal({
                title: "Are you sure?",
                text: "The removed account can not be retrieved",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, remove it.",
                closeOnConfirm: false
            },
            function(){
                window.location.replace(url);
            });


    });
 
   $('.test-input').unbind('keyup change input paste').bind('keyup change input paste',function(e){
        var $this = $(this);
        var val = $this.val();
        var valLength = val.length;
        var maxCount = $this.attr('maxlength');
        if(valLength>maxCount){
            $this.val($this.val().substring(0,maxCount));
        }
    });


    //-------------------------------------
    //---------------instant appointment
    $(".instant_appointment").change(function(){
            if($(this).prop('checked') == true){
                $('#instant_appointment_check').val('on');
               // alert($(this).prop('checked'));

            }else{
                $('#instant_appointment_check').val('off');
            }

        //$('#instant_appointment_check').prop('checked', false);
        $("#instant_appointment_frm").submit();

    });

    //------------------------------------------------------------notification page

    $(document).on('click','.app-cancel-btn',function(e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
                title: "Are you sure?",
                text: "Cancelled appointment will not be retrived.",
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
    //-------------------------------------manage service page

    $("#multiselect_service_combo").multiselect();

    $("#service_type_combo").click(function(){


        // var validator = $( "#manage_service_frm" ).validate();
        // validator.resetForm();

        $("#service_type_hidden").val($(this).val());
        $(".prescription_frm").hide();
        $(".manage_services_form").show();
        $(".select_regular").hide();
        $(".select_combo").show();
        $("#manage_service_frm").find("input[type=text]").val("");
        $("#error-less-100").hide();

    });
    $("#service_type_regular").click(function(){

        // var validator = $( "#manage_service_frm" ).validate();
        // validator.resetForm();

        $("#service_type_hidden").val($(this).val());
        $(".prescription_frm").hide();
        $(".manage_services_form").show();
        $(".select_combo").hide();
        $(".select_regular").show();
        $("#manage_service_frm").find("input[type=text]").val("");
        $("#error-less-30").hide();

    });
    $("#service_type_prescription").click(function(){

        // var validator = $( "#prescription_service_frm" ).validate();
        // validator.resetForm();

        $(".manage_services_form").hide();
        $(".prescription_frm").show();

    });
    //--------------------------------------------

    $("#photo").change(function() {

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    var places = new google.maps.places.Autocomplete(document.getElementById('address'));


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

        $('input[name="city"]').val(detectlocationcity);
        $('input[name="state"]').val(detectlocationstate);
        $('input[name="country"]').val(detectlocationcountry);

        ////end

    });

    var business_address = new google.maps.places.Autocomplete(document.getElementById('business_address'));

    google.maps.event.addListener(business_address, 'place_changed', function () {

        var results = business_address.getPlace();
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
    });


    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },

        boundary: {
            width: 300,
            height: 300
        }

    });

    $('#photo').on('change', function () {
        $('#blah').hide();
        $('.upload-demo').show();
        $('#provider_update').attr('data-type','profile')
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


    $uploadbannerCrop = $('#upload-demo-banner').croppie({
        enableExif: true,
        viewport: {
            width: 382,
            height: 223,
            type: 'square'
        },

        boundary: {
            width: 400,
            height: 300
        }

    });
    $('#ad_banner').on('change', function () {
        $('.stripe-button-el').removeAttr('disabled');
        $('.upload-demo').show();
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadbannerCrop.croppie('bind', {

                url: e.target.result

            }).then(function(){

            });
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('.stripe-button-el').on('click', function (ev) {
        var type ='banner';
        $uploadbannerCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            $.ajax({
                url: APP_URL+"/provider/image-crop",
                type: "POST",
                data: {"image":resp,"cropp_type":type},
                success: function (data) {
                    $('.upload-demo').hide();
                    $('#banner_image').html('<img src="'+resp+'" width="30%">');
                    $('#ad_banner_text').val(data.image);
                }
            });

        });
    });
    $('.Update_banner').on('click', function (ev) {
        var type = 'banner';
        $( "#la-ajaxloader" ).show();
        $uploadbannerCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            var string = resp.split(":");
            if(string[1]!=',') {
                $.ajax({
                    url: APP_URL + "/provider/image-crop",
                    type: "POST",
                    data: {"image": resp, "cropp_type": type},
                    success: function (data) {
                        $('.upload-demo').hide();
                        $('#banner_image').html('<img src="' + resp + '" width="30%">');
                        $('#ad_banner_text').val(data.image);
                        $("#la-ajaxloader").show();
                        $('#manage_advertisement').submit();
                    }
                });
            }else{
                        $('#manage_advertisement').submit();
            }

        });
    });

    $('.upload-result').on('click', function (ev) {

        ev.preventDefault();
        var type = $(this).attr("data-type");
        if(type == 'profile') {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: APP_URL + "/provider/image-crop",
                    type: "POST",
                    data: {"image": resp, "cropp_type": type},
                    success: function (data) {
                        $('.upload-demo').hide();
                        $('#blah').attr('src', resp).show();
                        /*$('#message').html('<div class="alert alert-success alert-white rounded notify"> ' +
                            '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> ' +
                            '<div class="icon"> <i class="fa fa-check"></i> </div>Profile image has been updated </div>');*/
                        $("#save_become_a_provider").submit();
                    }

                });


            });
        }else {
            $("#save_become_a_provider").submit();
        }
    });


    $uploadgalleryCrop = $('#upload-demo-gallery').croppie({
        enableExif: true,
        viewport: {
            width: 300,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 400,
            height: 300
        }

    });

    $('#gallery').on('change', function () {

        $('.upload-demo').show();
        $('.gallery_image').hide();
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadgalleryCrop.croppie('bind', {
                url: e.target.result
            }).then(function(){

            });
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.upload-result-gallery').on('click', function (ev) {
        ev.preventDefault();
        var type = $(this).attr("data-type");
        $uploadgalleryCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {

            $.ajax({
                url: APP_URL+"/provider/image-crop",
                type: "POST",
                data: {"image":resp,"cropp_type":type},
                success: function (data) {
                    $('.upload-demo').hide();
                    $('#image_div').append('<img src="'+resp+'" whdth="20%">&nbsp;').show();
                    $('#message').html('<div class="alert alert-success alert-white rounded notify"> ' +
                        '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> ' +
                        '<div class="icon"> <i class="fa fa-check"></i> </div>Image has been uploaded successfully. </div>');
                    setTimeout(function () { $(".alert-success").fadeOut(); }, 5000);
                    $('.gallery_btn').text('Add more image');
                    submitForm(data.gallery_id);
                }
            });

        });
    });
    $('.cancel_profile').on('click', function (ev) {
        window.location.reload();
    });
    $('.upload-result-gallery-edit').on('click', function (ev) {
        ev.preventDefault();
        var type = $(this).attr("data-type");
        var gallery_id = $(this).attr("data-gallery_id");
        $uploadgalleryCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {

            $.ajax({
                url: APP_URL+"/provider/image-crop",
                type: "POST",
                data: {"image":resp,"cropp_type":type,"gallery_id":gallery_id},
                success: function (data) {
                    $('.upload-demo').hide();
                    $('#image_div').append('<img src="'+resp+'" whdth="20%">&nbsp;').show();
                    $( "#la-ajaxloader" ).show();
                    $('#gallery_banner').submit();
                }
            });


        });
    });

    $('.close').click(function(){
        $('.gallery_image').hide();
        $('.update_banner_image').hide();
        $('.btn-bs-file').show();
    })
    function submitForm(id) {
        var form = $('#gallery_banner')[0];
        var formData = new FormData(form);
        formData.append('id', id);

        $.ajax({
            url: APP_URL+"/provider/gallery/store",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data) {

            }
        });

    }
    $(".edit_policy").click(function(){

        var type = $(this).attr('data-type');

        $.ajax({
            type:'GET',
            url:APP_URL+'/provider/policies_modal/'+type,
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                    $("#dynamicContentLoad").modal();
                CKEDITOR.replace('editor1')

            }
        });

    });
});

$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    }); 	
});

$(document).ready(function () {
    //called when key is pressed in textbox
    $("#Sort").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#error_msg_span").html("Digits Only").show().fadeOut("slow");
            return false;
        }
    });
    $('#Banking').on('keyup', function() {
        limitText(this, 8)
    });
    $('#Sort').on('keyup', function() {
        limitText(this, 6)
    });

    function limitText(field, maxChar){
        var ref = $(field),
            val = ref.val();
        if ( val.length > maxChar ){
            ref.val(function() {
                $("#error_msg_sort").html('<div class="alert alert-danger alert-white rounded notify"> ' +
                    '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> ' +
                    '<div class="icon"> <i class="fa fa-times"></i> </div>Maximum '+maxChar+' numbers only allowed</div>').show();
                setTimeout(function () { $("#error_msg_sort").fadeOut(); }, 5000)
                return val.substr(0, maxChar);
            });
        }
    }



});
Dropzone.options.myDropzone = {
    maxFilesize: 5, //mb- Image files not above this size
    uploadMultiple: true, // set to true to allow multiple image uploads
    parallelUploads: 15, //all images should upload same time
    maxFiles: 15, //number of images a user should upload at an instance
    acceptedFiles: ".png,.jpg,.jpeg", //allowed file types, .pdf or anyother would throw error
    addRemoveLinks: true, // add a remove link underneath each image to
    autoProcessQueue: false, // Prevents Dropzone from uploading dropped files immediately

    removedfile: function(file) {

        var name = file.name;
        if (name) {
            $.ajax({

                headers:{
                    'X-CSRF-Token':$('input[name="_token"]').val()
                }, //passes the current token of the page to image url

                type: 'GET',
                url: "/products/remove/"+name,  //passes the image name to  the method handling this url to //remove file
                dataType: 'json'
            });
        }
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

    },

    init: function() {
        var submitButton = document.querySelector("#submit-all")
        myDropzone = this; // closure

        submitButton.addEventListener("click", function() {
            myDropzone.processQueue(); // Tell Dropzone to process all queued files.
        });

// You might want to show the submit button only when
        // files are dropped here:
        this.on("addedfile", function() {
            // Show submit button here and/or inform user to click it.
        });

    }
};
//-----------

$(document).ready(function()
{
    $(".profile_preview").click(function(e)
    {

        e.preventDefault();
        
        var href= $(this).attr('href');

        var count = $(this).attr('data-value');

        if(count == '0')
        {
            swal("Oops.", 'Please create brands for your services.', "error");
          
        }
        else
        {
          window.location.replace(href);
        }
    })
})