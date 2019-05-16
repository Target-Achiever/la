@extends('layouts.admin_temp')
@section('content')
<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  div.seo-container {
    width: 55%;
    /*margin: 30px auto;*/
    padding: 30px;
    /*box-shadow: 0px 0px 10px 0px #ccc;*/
    border-radius: 10px;
}
.seo-container hr {
    border-top: 1px solid #10afec;
    margin-bottom: 25px;
}
.seo-container h3 {
    /*text-align: center;*/
    font-size: 20px;
    text-transform: capitalize;
}
.seo-container label {
    font-weight: 500;
    font-size: 15px;
}
.seo-container.fill-width {
    width: 100%;
}
.nav-tabs-custom {
    box-shadow: none;
}                                
</style>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="notification">
         <div class="box-header with-border">
            <div class="row">
               <div class="col-md-9 col-sm-9">
                  <h3 class="box-title">SEO Settings</h3>{!! displayAlert() !!}
               </div>

            </div>
            <br/>
            <!-- <div class="search">
               <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                     <div class="input-group">
                        <span class="input-group-addon"><i cla  ss="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search for Treatment type,name">
                     </div>
                  </div>
               </div>
            </div> -->
            <div class="perscription_box">
               <div class="col-md-12">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                     <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Title Settings</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">Home Page SEO</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true">Pages SEO</a></li>
                        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="true">Webmaster Tool</a></li>
                     </ul>
                     <div class="tab-content">
                        <!-- tan 1 content -->
                        <div class="tab-pane active" id="tab_1">
                          <div class="seo-container">
                            <h3>Title Settings</h3>
                            <hr>
                          <!--  <form method="post" action="{{url('admin/seo')}}"> -->
                            @if(isset($setting))
    {{ Form::model($setting, ['url' => ['admin/seo', $setting->id], 'method' => 'patch','id'=>'setting']) }}
@else
    {{ Form::open(['url' => 'admin/seo','id'=>'setting']) }}
@endif
                           
                              <div class="form-group">
                                <label>Website Name</label>
                               <!--  <input name="site_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Webiste Name"> -->
                                 {{ Form::text('site_name', old('site_name'),array('id'=>'exampleInputEmail1','placeholder'=>'Enter Webiste Name','class'=>'form-control','aria-describedby'=>'emailHelp')) }}
                                <small class="form-text text-muted">That given name is going to be used for a web search.</small>
                              </div>
                              <div class="form-group">
                                <label>Title Separator</label>
                               <!--  <select class="form-control" name="title_separator">
                                <option>Choose..</option>
                                <option value="-">-</option>
                                <option value="|">|</option>
                              </select> -->
                                {{ Form::select('title_separator',array(''=>'Select','-'=>'-','|'=>'|'),old('title_separator'),array('class'=>'form-control','required'=>'required')) }}
                              </div>
                              
                              <button type="submit" class="btn btn-primary" name="setting" value="Submit">Submit</button>
                          <!-- </form> -->
                          {{ Form::close() }}
                        </div>
                        </div>
                        <!-- tab 1 content end -->
                        <!-- tan 2 content -->
                        <div class="tab-pane" id="tab_2">
                           <div class="seo-container">
                            <h3>Home Page SEO</h3>
                            <hr>
                           @if(isset($home_page))
    {{ Form::model($home_page, ['url' => ['admin/seo', $home_page->id], 'method' => 'patch', 'class'=>'home_p']) }}
@else
    {{ Form::open(['url' => 'admin/seo','class'=>'home_p']) }}
@endif
                              <div class="form-group">
                                <label>SEO Title</label>
                                 {{ Form::text('title', old('title'),array('placeholder'=>'SEO Title','class'=>'form-control','required'=>'required')) }}
                              </div>
                              <div class="form-group">
                                <label>Focus Keyword</label>
                               
                                  {{ Form::text('keyword', old('keyword'),array('placeholder'=>'Enter Keyword','class'=>'form-control','required'=>'required')) }}

                                  {{ Form::hidden('page',0) }}
                              </div>
                              <div class="form-group">
                                <label>Meta Description</label>
                                  {{ Form::textarea('description', old('description'),array('rows'=>6,'class'=>'form-control','required'=>'required')) }}
                              
                                <small class="form-text text-muted">Write your SEO  contents here to boost up your website points.</small>
                              </div>
                              
                              <button type="submit" class="btn btn-primary" name="home">Submit</button>
                          {{ Form::close() }}
                        </div>
                          
                        </div>
                        <!-- tab 2 content end -->
                        <!-- tan 3 content -->
                        <div class="tab-pane" id="tab_3">
                           <div class="seo-container">
                            <h3>Pages SEO</h3>
                            <hr>
                         
    {{ Form::open(['url' => 'admin/seo','id'=>'form_page', 'class'=>'other_p']) }}
                            <div class="form-group">
                                <label>Select Page</label>
        {{ Form::select('page',array(''=>'Select',1=>'About',2=>'Blog',3=>'Services',4=>'Privacy',5=>'Terms'),old('page'),array('class'=>'form-control other_p','id'=>'page','onchange'=>'select_topic(this.value,"")')) }}
                              </div>
                              <div id="topic">
                              </div>
                              <div class="form-group">
                                <label>SEO Title</label>
                                 {{ Form::text('title', old('title'),array('placeholder'=>'SEO Title','class'=>'form-control','id'=>'title','required'=>'required')) }}
                              </div>
                              <div class="form-group">
                                <label>Focus Keyword</label>
                                {{ Form::text('keyword', old('keyword'),array('placeholder'=>'Enter Keyword','class'=>'form-control','id'=>'keyword','required'=>'required')) }}
                              </div>
                              <div class="form-group">
                                <label>Meta Description</label>
                                {{ Form::textarea('description', old('description'),array('rows'=>6,'class'=>'form-control','id'=>'description','required'=>'required')) }}
                                <small class="form-text text-muted">Write your SEO  contents here to boost up your website points.</small>
                              </div>
                              
                              <button type="submit" class="btn btn-primary" name="pages">Submit</button>
                         {{ Form::close() }}
                        </div>
                        <!-- table section start -->
                        <?php 
                         
                         if(isset($blog))
                         {
                         foreach ($blog as $key => $value) {
                          $blog[$value->id] = $value->blog_header;
                         }
                         }
                       if(isset($services))
                         {
                         foreach ($services as $key => $value) {
                          $service[$value->services_id] = $value->service;
                         }
                       }
                        ?>
                           <section class="page-seo">            
                                       <div class="box">
                                          <div class="box-header with-border">
                                             <h3 class="box-title">List of SEO Pages</h3> 
                                             <div class="table_box">
                                                <table  class="table table-bordered table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th>S.No</th>
                                                        <th>Select Page</th>
                                                        <th>Topic</th>
                                                        <th>SEO Title</th>
                                                        <th>Focus Keyword</th>
                                                        <th>Meta Description</th>
                                                        <th>Actions</th>
                                                      </tr>
                                                    </thead>
                                                    @if(isset($pages))
                                                    <tbody>
                                                      <?php $i=1; ?>
                                                       @foreach ($pages as $page)
                                                       
                                                      <tr>
                                                        <td>{{$i}}</td>
                                                        <td>@if($page->page == 1)About
                                                        @endif
                                                        @if($page->page == 2)Blog @endif
                                                      @if($page->page == 3)Services @endif
                                                    @if($page->page == 4)Privacy @endif
                                                    @if($page->page == 5)Terms @endif</td>
                                                        <td>@if($page->page == 2 && $page->sub_topic > 0){{$blog[$page->sub_topic]}} @endif @if($page->page == 3 && $page->sub_topic > 0){{$service[$page->sub_topic]}} @endif</td>
                                                        <td>{{$page->title}}</td>
                                                        <td>{{$page->keyword}}</td> 
                                                        <td>{{$page->description}}</td>
                                                        <td>
                                                        <!-- <span><a href="javascript:void(0)" onclick="seo_page(@php echo $page->id @endphp,'view');"><i class="fa fa-stethoscope"> View &nbsp;</i></a></span> -->
                                                        <span><a href="javascript:void(0)" onclick="seo_page(@php echo $page->id @endphp,'edit');"><i class="fa fa-pencil" aria-hidden="true"></i> Edit &nbsp;</i> </a></span>
                                                        <span><a class="" href="javascript:void(0)" onclick="seo_page_delete(@php echo $page->id @endphp,'page');"><i class="fa fa-trash">
                                                          Delete</i></a>  </span>
                                                        </td>                           
                                                      </tr>
                                                     <?php $i++; ?>
                                                      @endforeach
                                                   </tbody>
                                                   @endif
                                               </table>                         

                                             </div>
                                       </div>
                                    </div>
                            </section>
                        <!-- table section end -->
                        </div>
                        <!-- tab 3 content end -->
                        <!-- tan 4 content -->
                        <div class="tab-pane" id="tab_4">
                           <div class="seo-container fill-width">
                            <h3>Webmaster</h3>
                            <hr>
                         
    {{ Form::open(['url' => 'admin/seo','id'=>'form_web']) }}

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                  <label>Webmaster</label>
                                
                                 {{ Form::select('web_master',array(''=>'Select',0=>'Google',1=>'Bling',2=>'Alexa',3=>'Pinterest',4=>'Yandex'),old('web_master'),array('class'=>'form-control','id'=>'web_master','required'=>'required')) }}
                                </div>
                                <div class="form-group col-md-5">
                                  <label>Verification Code</label>
                                  {{ Form::text('verification_code', old('verification_code'),array('placeholder'=>'Enter verification code','class'=>'form-control','id'=>'verification_code','required'=>'required')) }}
                                </div>
                                
                                <div class="form-group col-md-2">
                                   <label style="visibility:hidden;">Verification Code</label>
                                  <button type="submit" name="web" class="btn btn-primary">Add</button>
                                </div>
                                
                            </div>
                         {{ Form::close() }}
                        </div>
                        <!-- table section start -->
                        <br/><br/><br/><br/>
                           <section class="webmatert-tab">            
                                       <div class="box">
                                          <div class="box-header with-border">
                                             <h3 class="box-title">List of Webmaster</h3> 
                                             <div class="table_box">
                                                <table  class="table table-bordered table-hover">
                                                    <thead>
                                                      <tr>
                                                        <th>S.No</th>
                                                        <th>Webmaster</th>
                                                        <th>Verification Code</th>
                                                        <th>Actions</th>
                                                        
                                                      </tr>
                                                    </thead>
                                                      @if(isset($web))
                                                    <tbody>
                                                      <?php $w=1; ?>
                                                       @foreach ($web as $val)
                                                       
                                                      <tr>
                                                        <td>{{ $w }}</td>
                                                        <td>@if($val->web_master == 0)Google
                                                        @endif
                                                        @if($val->web_master == 1)Bling @endif
                                                      @if($val->web_master == 2)Alexa @endif
                                                    @if($val->web_master == 3)Pinterest @endif
                                                    @if($val->web_master == 4)Yandex @endif</td>
                                                        <td>{{$val->verification_code}}</td>
                                                        <td>
                                                      <!--   <span><a href="javascript:void(0)"><i class="fa fa-stethoscope"> View &nbsp;</i></a></span> -->
                                                        <span><a onclick="web_edit(@php echo $val->id @endphp)" href="javascript:void(0)" ><i class="fa fa-pencil" aria-hidden="true"></i> Edit &nbsp;</i> </a></span>
                                                        <span><a class="" href="javascript:void(0)" onclick="seo_page_delete(@php echo $val->id @endphp,'web');"><i class="fa fa-trash">
                                                          Delete</i></a>  </span>
                                                        </td>                           
                                                                        
                                                      </tr>
                                                       <?php $w++; ?>
                                                      @endforeach
                                                   </tbody>
                                                   @endif
                                               </table>                        

                                             </div>
                                       </div>
                                    </div>
                            </section>
                        <!-- table section end -->
                        </div>
                        <!-- tab 4 content end -->
                     </div>
                     <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
               </div>
            </div>
         </div>
      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->         
@endsection


 <script>
         function seo_page(id,type){
            $.ajax({
               type:'post',
               url: '@php echo url('admin/seo_page') @endphp',
               datatype:'JSON',
               data: {_token : '<?php echo csrf_token() ?>' ,id :id, type:type},
               success:function(data){
                if(type == 'edit')
                  {
                  var dat = JSON.parse(data);
                  $('#page').prop('disabled',true);
                  $('#title').val(dat.title);
                  $('#keyword').val(dat.keyword);
                  if(dat.page == 2  || dat.page == 3)
                  {
                  select_topic(dat.page,dat.sub_topic);
                  }
                  $('#description').val(dat.description);
                  $('#page option[value='+dat.page+']').attr("selected", "selected");
                  $('#form_page').attr('action', "seo/"+dat.id);
                  $('#form_page').attr('method', "patch");
                  document.body.scrollTop = 0; // For Safari
                   document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                  }
               }
            });
         }


function seo_page_delete(id,type){

            if(arguments[0] != null){
      swal({
          title: "Are you sure?",
          text: "Are you sure you want to delete???",
          type: "warning",
          showCancelButton: true,
      confirmButtonClass: "btn-danger",
          confirmButtonColor: '#DD6B55',
          confirmButtonText: "Yes, I am sure!",
          cancelButtonText:  "No, cancel it!",
          closeOnConfirm: false,
          closeOnCancel: false
    },
    function(isConfirm)
    {
        if (isConfirm){

            $.ajax({
               type:'post',
               url: '@php echo url('admin/seo_page_delete') @endphp',
               data: {id :id, type:type},
               success:function(data){
                 swal({
                    title: "Deleted Successfully...",
                    confirmButtonText: "ok",
                    type:"success",
                    allowOutsideClick: "true",
                    confirmButtonColor:"#10AFEC"
                }, function () { window.location.href =  '@php echo url('admin/seo') @endphp'; })
                
              }
              
            });

            $("#la-ajaxloader").css("display", "none");

          }
          
          else {
            swal("Cancelled", "", "error");
            e.preventDefault();
        }
      });

    }
    else{
    return false;
  }
  return;

  }

  function web_edit(id){
            $.ajax({
               type:'post',
               url: '@php echo url('admin/seo_web_view') @endphp',
               datatype:'JSON',
               data: {id :id},
               success:function(data){
                
                  var dat = JSON.parse(data);
                 
                  $('#verification_code').val(dat.verification_code);
                  $('#web_master option[value='+dat.web_master+']').attr("selected", "selected");
                  $('#form_web').attr('action', "seo/"+dat.id);
                  $('#form_web').attr('method', "patch");
                   document.body.scrollTop = 0; // For Safari
                   document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
                  
               }
            });
         }

function select_topic(id,sub_topic="")
{
  
  if(id == 3 || id == 2)
  {
     $.ajax({
               type:'post',
               url: '@php echo url('admin/seo_topic') @endphp',
               datatype:'JSON',
               data: {id :id,sub_topic : sub_topic},
               success:function(data){

                $('#topic').html(data);

               }
      });

  }
}


      </script>