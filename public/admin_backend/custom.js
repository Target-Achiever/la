$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//====================================================
/* ----------------scrpts for pages ADMIN-------------------*/
// 1. manage service
// 2. user feedbacks
// 3. user policy

/* ----------------scrpts for pages ADMIN END-------------------*/
$( "#la-ajaxloader" ).hide();
window.setTimeout(function () {
    $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
    $(".alert-danger").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
    $(".alert-warning").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 5000);

$( document ).ajaxStart(function()
{
    $( "#la-ajaxloader" ).show();
});
$( document ).ajaxComplete(function()
{
    $( "#la-ajaxloader" ).hide();
});
$(function ()
{

    //--------------------------------

    $(document).on("click",".change_row_status", function( event ) {//this click event for all status changes/delete row in table

        event.preventDefault();


        var url = $(this).attr('href');

        swal({
                title: "Are you sure you want to this changes?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Change it.",
                cancelButtonText: "No, Cancel please.",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    location.href = url;      // submitting the form when user press yes
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            });


    });
    //--------------------------------------------------la-home- header-text
    $(".la-home-header").click(function(){

        $.ajax({
            type:'POST',
            url:APP_URL+'/admin/get_home_header_text',
            success:function(data){

                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });

    });
    $('#search').on('keyup',function(){

        $value=$(this).val();
        $_token = $('input[name="_token"]').val();
        $.ajax({

            type : 'post',

            url : 'search',

            data:{'search':$value,'_token':$_token},

            success:function(data){

                $('#example1').html(data);

            }

        });
    });
    //--------------------------------------------------------------------------datatable section
    var provider_policy = $('#providers_policy').DataTable();
    //-----------------------------------------------------------
    var mailchimp_endusers = $('#mailchimp_endusers').DataTable({dom: 'Bfrtip',
        buttons: [ { "extend": 'csv', "text":'Csv',"className": 'btn btn-primary ' },
            { "extend": 'excel', "text":'Excel',"className": 'btn btn-primary ' },
            { "extend": 'pdf', "text":'Pdf',"className": 'btn btn-primary ' },]});
    var mailchimp_providers = $('#mailchimp_providers').DataTable({dom: 'Bfrtip',
        buttons: [
            { "extend": 'csv', "text":'Csv',"className": 'btn btn-primary ' },
            { "extend": 'excel', "text":'Excel',"className": 'btn btn-primary ' },
            { "extend": 'pdf', "text":'Pdf',"className": 'btn btn-primary ' },
        ]});
    //----------------------------------------------------------------

    $('#provider_policy_search').on( 'keyup', function () {
        provider_policy.search( this.value ).draw();
    } );
    //--------------------------------------------------------------------------datatable section end
    //--------------------------------------------------------------------------manage service page
    $(".destroy-element").click(function(){
        var form_id = $(this).attr("data-service");
        swal({
                title: "Are you sure you want to delete?",
                text: "This data will be delete permanently.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete it.",
                cancelButtonText: "No, Cancel please.",
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

    //--------------------------------------------------------------------------manage service page end

    //--------------------------------------------------------------------------users feedbacks page
    $('#home_page').change(function() {
        var type = $(this).is(':checked');
        $.ajax({
            type:'GET',
            url:APP_URL+'/admin/save_setting/'+type,
            success:function(data){
                $('#alert').html('<div class="alert alert-success alert-white rounded notify"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> <div class="icon"> <i class="fa fa-check"></i> </div>Setting is updated successfully</div>')
            }
        });
    });
    $(".view-feedback").click(function(){

        var id = $(this).attr("data-feedback");

        $.ajax({
            type:'GET',
            url:APP_URL+'/admin/view_user_feedback/'+id,
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });
    })

    $(".remove-feedback").click(function(){
        var url = $(this).attr("data-href");
        swal({
                title: "Are you sure you want to remove?",
                text: "This data will be delete permanently.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete it.",
                cancelButtonText: "No, Cancel please.",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    location.href = url;      // submitting the form when user press yes
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            });

    });
    //--------------------------------------------------------------------------users feedbacks page end
    //--------------------------------------------------------------------------users policy page
    $(".view-policy").click(function(){

        var id = $(this).attr("data-policy");

        $.ajax({
            type:'GET',
            url:APP_URL+'/admin/policies/'+id,
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });
    })
    //--------------------------------------------------------------------------users policy page end
    //--------------------------------------------------------------------------ad page
    $('.modal-view-ad').click(function(){

        var ad = $(this).attr('data-ad');

        $.ajax({
            type:'GET',
            url:APP_URL+'/admin/advertisements/'+ad,
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });

    });

    $('.ad_setting').click(function(){
        $.ajax({
            type:'GET',
            url:APP_URL+'/admin/advertisements_amount',
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });

    });

    var CSRF_TOKEN = $('input[name="_token"]').val();
    $(".submit_amount").click(function(){
        $.ajax({
            /* the route pointing to the post function */
            url:APP_URL+'/admin/advertisements/store',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {_token: CSRF_TOKEN, ad_amount:$('#ad_amount').val(), id:$('#id').val()},
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) {

                if(data.status=='empty'){
                    $('.text-danger').html('The ad_amount field is null ');
                }else{
                    $('#dynamicContentLoad').modal('toggle');
                    $('tbody').html(data);
                    $('#example1').DataTable();
                }
            }
        });
    });

    $('.edit_ad_amount').click(function(){

        var amount_id = $(this).attr('data-id');
        $.ajax({
            type:'GET',
            url:APP_URL+'/admin/advertisements_update/'+amount_id,
            success:function(data){
                $("#dynamicContentLoad .modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });

    });
    $(".ad_days").click(function(){
        $('#ad_weeks').prop('checked', false);
        $.ajax({
            type:'GET',
            url:APP_URL+'/admin/advertisements_days',
            data:{ad_days:$('#ad_days').val(),ad_weeks:'2'},
            success:function(data){
                $('#alert').html('<div class="alert alert-success alert-white rounded notify"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> <div class="icon"> <i class="fa fa-check"></i> </div>Setting is updated successfully</div>')
            }
        });
    });

    $(".ad_weeks").click(function(){
        $('#ad_days').prop('checked', false);
        $.ajax({
            type:'GET',
            url:APP_URL+'/admin/advertisements_days',
            data:{ad_weeks:$('#ad_weeks').val(),ad_days:'2'},
            success:function(data){
                $('#alert').html('<div class="alert alert-success alert-white rounded notify"> <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> <div class="icon"> <i class="fa fa-check"></i> </div>Setting is updated successfully</div>')

            }
        });
    });
    $(".deactivate_provider").click(function(){
        var provider_id = $(this).attr("data-service");
        var _token = $('input[name="_token"]').val();

        swal({
            title: "Are you sure you want to deactivate this user?",
            text: "<textarea id='editor1' rows='5' cols='50'></textarea>",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Deactivate it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                if ($('#editor1').val() === "") {
                    swal.showInputError("You need to write something.");
                    return false
                }
                $('.admin_status_text').val($('#editor1').val());
                $("#deactivate-form-"+provider_id).submit();


            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });
    $(".deactivate_user").click(function(){
        var user_id = $(this).attr("data-service");
        var _token = $('input[name="_token"]').val();

        swal({
            title: "Are you sure you want to deactivate this user?",
            text: "<textarea id='editor1' rows='5' cols='50'></textarea>",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Deactivate it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                if ($('#editor1').val() === "") {
                    swal.showInputError("You need to write something.");
                    return false
                }
                $('.admin_status_text').val($('#editor1').val());
                $("#deactivate-form-"+user_id).submit();


            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });

    $(".active_provider").click(function(){
        var provider_id = $(this).attr("data-service");
        swal({
            title: "Are you sure you want to active this user?",
            text: "<textarea id='editor1' rows='5' cols='50'></textarea>",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#2c994e",
            confirmButtonText: "Yes, Active it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                if ($('#editor1').val() === "") {
                    swal.showInputError("You need to write something.");
                    return false
                }
                $('.admin_status_text').val($('#editor1').val());
                $("#deactivate-form-"+provider_id).submit();

            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });

    $(".approve_provider").click(function(){
        var provider_id = $(this).attr("data-service");
        swal({
            title: "Are you sure you want to approve this provider?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2c994e",
            confirmButtonText: "Yes, Approve it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $("#approve-form-" + provider_id).submit();

            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });

    $(".delete_provider").click(function(){
        var provider_id = $(this).attr("data-service");
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Are you sure you want to delete this user?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Delete it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $("#delete-form-"+provider_id).submit();
            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });

    $(".reject_provider").click(function(){
        var provider_id = $(this).attr("data-service");
        var _token = $('input[name="_token"]').val();
        swal({
            title: "Are you sure you want to reject this provider?",
            text: "<textarea id='editor1' rows='5' cols='50'></textarea>",
            html: true,
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Reject it.",
            cancelButtonText: "No, Cancel please.",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                if ($('#editor1').val() === "") {
                    swal.showInputError("You need to write something @mail.");
                    return false
                }
                $('.admin_status_text').val($('#editor1').val());
                $("#delete-form-"+provider_id).submit();
            } else {
                swal("Cancelled", "Your data is safe :)", "error");
            }

        });
    });

    $('#provider_search').on('keypress',function(){

        $value = $(this).val();
        $status = $(this).attr('data-type');
        $_token = $('input[name="_token"]').val();
        $.ajax({
            type : 'post',
            url : 'provider_search',
            data:{'search':$value,'_token':$_token,'status':$status},
            success:function(data){
                $('#example1').html(data);
            }

        });
    });


    $(".notification_bar").click(function()    {
        var notif_from = $(this).attr('data-noti-from');
        var noti_id = $(this).attr('data-noti-id');
        var noti_type = $(this).attr('data-noti-type');
        $.ajax({
            type: 'GET',
            url: APP_URL + '/admin/notification_ajax/' + noti_id + '/' + notif_from,
            success: function (data) {
                if(noti_type === '4') {
                    $("#dynamicContentLoad").find(".modal-body").html(data);
                    $("#dynamicContentLoad").modal();
                }else if(noti_type === '5') {
                    window.location.assign(APP_URL+"/admin/pending_profile/"+notif_from);
                }
                $("#notif-id-" + noti_id).removeClass('alert-info').addClass('alert-default');


            }
        });
    });
    $(".remove_banner").click(function()    {
        $('.home_banner_image').hide();
        $('.btn-bs-file').show();
    });
    $uploadbannerCrop = $('#upload-demo-banner').croppie({
        enableExif: true,
        viewport: {
            width: 1366,
            height: 516,
            type: 'square'
        },

        boundary: {
            width: 1500,
            height: 600
        }

    });
    $('#home_banner').on('change', function () {
        $('.upload-demo').show();
        $('.upload-result-banner').attr('data-type','home_banner');
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadbannerCrop.croppie('bind', {

                url: e.target.result

            }).then(function(){


            });
        }
        reader.readAsDataURL(this.files[0]);
    });


    $('.upload-result-banner').on('click', function (ev) {
        $( "#la-ajaxloader" ).show();
        var type = $(this).attr("data-type");
        if(type == 'home_banner') {
            $uploadbannerCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: APP_URL + "/admin/image-crop",
                    type: "POST",
                    data: {"image": resp, "cropp_type": type},
                    success: function (data) {
                        $( "#la-ajaxloader" ).hide();
                        $('.upload-demo').hide();
                        $('#banner_image').html('<img src="' + resp + '" width="50%">');
                        $('#home_banner_image').val(data.image);
                        $('#manage_home_form').submit();
                    }
                });

            });
        }else {
            $('#manage_home_form').submit();
        }
    });

    $uploadservicesCrop = $('#upload-demo-services').croppie({
        enableExif: true,
        viewport: {
            width: 328,
            height: 246,
            type: 'square'
        },

        boundary: {
            width: 500,
            height: 300
        }

    });
    $('#service_banner').on('change', function () {
        $('.upload-demo').show();
        $('.upload-result-services').attr('data-type','service_banner');
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadservicesCrop.croppie('bind', {

                url: e.target.result

            }).then(function(){

            });
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.upload-result-services').on('click', function (ev) {
        $( "#la-ajaxloader" ).show();
        var type = $(this).attr("data-type");
        if(type == 'service_banner') {
            $uploadservicesCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                $.ajax({
                    url: APP_URL + "/admin/image-crop",
                    type: "POST",
                    data: {"image": resp, "cropp_type": type},
                    success: function (data) {
                        $( "#la-ajaxloader" ).hide();
                        $('.upload-demo').hide();
                        $('#banner_image').html('<img src="' + resp + '" width="30%">');
                        $('#service_banner_image').val(data.image);
                        $('#manage_service_form').submit();
                    }
                });

            });
        }else {
            $('#manage_service_form').submit();
        }
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#about_banner").change(function() {

        readURL(this);
    });
    $("#blog_banner").change(function() {

        readURL(this);
    });
    $("#gain_banner").change(function() {
        readURL(this);
    });
    $("#service_banner").change(function() {
        readURL(this);
    });
    $(".search_count").click(function()    {
        $.ajax({
            type: 'GET',
            url: APP_URL + '/admin/search_by_provider',
            success: function (data) {
                $("#dynamicContentLoad").find(".modal-body").html(data);
                $("#dynamicContentLoad").modal();
            }
        });
    });
    //-------------------seo
                $("#setting").validate({
                rules: {
                 site_name: "required", 
                 title_separator: "required", 
               }
              });

             $(".home_p").validate({
                rules: {
                  page: "required",
                 keyword:  "required",
                 description : "required",
                 title:"required", 
               }
              });

             $(".other_p").validate({
                rules: {
                  page: "required",
                 keyword:  "required",
                 description : "required",
                 title:"required", 
               }
              });

               $("#form_web").validate({
                rules: {
                 web_master: "required", 
                 verification_code:"required", 
               }
              });
});//============================================

