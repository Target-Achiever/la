<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SeoTitleSettings;
use App\SeoPages;
use App\SeoWeb;

use App\Services;

use App\Blog;



use Illuminate\View\Middleware\ShareErrorsFromSession;


class SeoController extends Controller
{
    public function index(){

    $setting = SeoTitleSettings::first();

    $home_page = SeoPages::where('page', '=', 0)->first();

    $pages = SeoPages::where('page', '!=', 0)->get();

    $web = SeoWeb::all();

    $blog = Blog::where( 'blog_status', '=', '1' )->get();

    $services=Services::where (function ($query){ $query -> where('service_type','=','4')
            -> orWhere('service_type','=','1'); })->get();


    return view('admin.seo',compact('setting','home_page','pages','web','blog','services'));
   }

   public function seo_settings(Request $request){

    	$data = $request->all();

    	/*--------------------------------Setting Insert-------------------------------------*/

    	if(isset($data['setting'])){

    $this->validate($request,[
                                'site_name' => 'required',
                                'title_separator' => 'required'
                              ]);
 

    	SeoTitleSettings::create( $data );
    }
      /*--------------------------------Home title Insert-----------------------------------*/
    if(isset($data['home']) || isset($data['pages']))
    {

    	
    	$this->validate($request,[
                                'title' => 'required',
                                'keyword' => 'required',
                                'description'=>'required',
                                'page'=>'required'
                              ]);

         if($data['page'] == 2 || $data['page'] == 3)
         {

         $result = SeoPages::where('page', '=', $data['page'])->where('sub_topic','=',$data['sub_topic'])->get();
       }
       else
       {

        $result = SeoPages::where('page', '=', $data['page'])->get();
       }

        if(isset($result) && count($result) > 0)
        {
        	return redirect('admin/seo')->with('success','danger|Page details already exists');
        }

       

    	SeoPages::create( $data );
    	//print_r($insert);  exit;
    }

    if(isset($data['web'])){

    	$this->validate($request,[
                                'web_master' => 'required',
                                'verification_code' => 'required'
                              ]);

    	$result = SeoWeb::where('web_master', '=', $data['web_master'])->get();

        if(isset($result) && count($result) > 0)
        {
        	return redirect('admin/seo')->with('success','danger|Details already exists for this webmaster');;
        }

    	SeoWeb::create( $data );
    }

    	 
         	return redirect('admin/seo')->with('success','success|Added successfully');

   }

   public function seo_settings_update(Request $request,$id){


   	    $data = $request->all();

   	    unset($data['_method']);
        
        unset($data['_token']);

        if(isset($data['setting'])){

        unset($data['setting']);

   	  $this->validate($request,[
                                'site_name' => 'required',
                                'title_separator' => 'required'
                              ]);

   	   
   	    SeoTitleSettings::where('id', '=', $id)->update($data);

     	}

      /*--------------------------------Home title update-----------------------------------*/
    if(isset($data['home']) || isset($data['pages']))
    {
    	unset($data['home']);
    	unset($data['pages']);

    $this->validate($request,[
                                'title' => 'required',
                                'keyword' => 'required',
                                'description'=>'required',
                                'page'=>'required'
                              ]);

    	

    	 SeoPages::where('id', '=', $id)->update($data);
    	//print_r($insert); 
    }

    if(isset($data['web'])){

    	unset($data['web']);

    	$this->validate($request,[
                                'web_master' => 'required',
                                'verification_code' => 'required'
                              ]);

    	SeoWeb::where('id', '=', $id)->update($data);
    }

   	return redirect('admin/seo')->with('success','success|Updated successfully');


   }

   public function seo_page(Request $request){

   	$data = $request->all();

   
   	$arr = Array();

   $result = SeoPages::where('id', '=', $data['id'])->get();

   foreach ($result as $key => $value) {

   	$arr['id'] =  $value->id;
   	$arr['page'] =  $value->page;
   	$arr['title'] =  $value->title;
   	$arr['keyword'] =  $value->keyword;
   	$arr['description'] =  $value->description;
    $arr['sub_topic'] =  $value->sub_topic;
  
   }

   echo json_encode($arr);  
   	
   }

   public function seo_page_delete(Request $request){

   	$data = $request->all();

   	if($data['type'] == 'page')
   	{

   	$result = SeoPages::where('id', '=', $data['id'])->delete();

   }

   else
   {

   	$result = SeoWeb::where('id', '=', $data['id'])->delete();
   }

   	$return['status'] = TRUE;
   	$return['message'] = 'Deleted';

   	return response()->json($return);

   }

   public function seo_web_view(Request $request){

   	$data = $request->all();

   
   	$arr = Array();

   $result = SeoWeb::where('id', '=', $data['id'])->get();

   foreach ($result as $key => $value) {

   	$arr['id'] =  $value->id;
   	$arr['web_master'] =  $value->web_master;
   	$arr['verification_code'] =  $value->verification_code;
  
   }

   echo json_encode($arr);  
   	
   }

   public function seo_topic(Request $request)
   {

      $data = $request->all();

      if($data['id'] == 2)
      {

      $blog = Blog::where( 'blog_status', '=', '1' )->get();

      $options = array('Select' => 'Please select');
      if($data["sub_topic"] != "")
      {
      $html = '<div class="form-group"><label>Select Topic</label><select class="form-control" disabled name="sub_topic" id="sub_topic"><option value="0">Main Page</option>';
      }
      else
      {
      $html = '<div class="form-group"><label>Select Topic</label><select class="form-control" name="sub_topic" id="sub_topic"><option value="0">Main Page</option>';
      }
       
      foreach ($blog as $key => $value) {
       //$options += array($value->id => $value->blog_header);
        if($value->id == $data["sub_topic"])
        {
          $select  = "selected";
        }
        else
        {
          $select = "";
        }
      $html.='<option value="'.$value->id.'"'.$select.'>'.$value->blog_header.'</option>';
      }
      $html.= '</select></div>';
      }
      else
      {

      $services=Services::where (function ($query){ $query -> where('service_type','=','4')
            -> orWhere('service_type','=','1'); })->get();

      if($data["sub_topic"] != "")
      {
      $html = '<div class="form-group"><label>Select Topic</label><select class="form-control" disabled name="sub_topic" id="sub_topic"><option value="0">Main Page</option>';
      }
      else
      {
      $html = '<div class="form-group"><label>Select Topic</label><select class="form-control" name="sub_topic" id="sub_topic"><option value="0">Main Page</option>';
      }

      foreach ($services as $key => $value) {
         if($value->services_id == $data["sub_topic"])
        {
          $select  = "selected";
        }
        else
        {
          $select = "";
        }
         //$options += array($value->services_id => $value->service);

         $html.='<option value="'.$value->services_id.'"'.$select.'>'.$value->service.'</option>';
      }

       $html.= '</select></div>';
      }

      echo $html;

   }

}
