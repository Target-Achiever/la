<?php

namespace App\Http\Controllers\Admin;

use App\AdminSettings;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as IRequest;

class ManageHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screen = AdminSettings::where('status','=','1')->get();
        return view('admin.manage_home',compact('screen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_edit_home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IRequest $request)
    {
        $inputs = Request::all();

        if($inputs['header_text'] == '' && $inputs['home_banner_image'] == '')
        {
            $this->validate($request ,[

                'type'=>'required',
                'header_text' => 'required'
            ]);
            
        }

        $user_id = Auth::user()->id;

        $data['header_text'] = $inputs['header_text'];

        if($inputs['home_banner_image'] != '')
        $data['home_banner'] = $inputs['home_banner_image'];

        $data['type'] = $inputs['type'];
        $data['status'] = '1';

       /* if (Request::hasFile('home_banner')) {

            $file = Request::file("home_banner");
            $photo = $user_id."_".time().'.'.$file->getClientOriginalExtension();
            $data['home_banner'] = $photo;
            $file->move(public_path('uploads/home_banner'), $photo);

        }*/
        AdminSettings::create($data);

        return redirect('admin/manage_home')->with('success','success|Home banner has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $screen = AdminSettings::find($id);

        return view('admin.create_edit_home',compact('screen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = Request::all();
        $user_id = Auth::user()->id;
        $data['header_text'] = $inputs['header_text'];


        $data['type'] = $inputs['type'];
        $data['status'] = '1';
        $screen = AdminSettings::find($id);
        if($inputs['home_banner_image']){
            $data['home_banner'] = $inputs['home_banner_image'];
        }
        else{
            $data['home_banner'] = $screen->home_banner;
        }
        AdminSettings::where('id',$id)->update($data);
        return redirect('admin/manage_home')->with('success','success|Home banner has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       AdminSettings::where('id','=',$id)->update(['status' => '2']);
       return redirect('admin/manage_home')->with('success','success|Home page content has been deleted successfully');
    }

    /**
     * @param Requestss $request
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function image_crop(Request $request){

        $input = Request::all();
        $data = $input['image'];
        $user_id = Auth::user()->id;
        list( $type, $data ) = explode( ';', $data );
        list( , $data ) = explode( ',', $data );
        $data = base64_decode( $data );
        $image_name = $user_id.'_'.time() . '.png';

        file_put_contents( public_path( 'uploads/home_banner/' . $image_name ), $data );

        return response()->json(['image' => $image_name ]);
    }*/
    public function image_crop(Request $request){

        $input = Request::all();
        $data = $input['image'];
        $user_id = Auth::user()->id;
        list( $type, $data ) = explode( ';', $data );
        list( , $data ) = explode( ',', $data );
        $data = base64_decode( $data );
        $image_name = $user_id . '_' . time() . '.png';

        if($input['cropp_type']== 'home_banner') {

            file_put_contents( public_path( 'uploads/home_banner/' . $image_name ), $data );
        }
        elseif ($input['cropp_type'] == 'service_banner'){
            file_put_contents( public_path( 'uploads/service_banner/' . $image_name ), $data );
        }

        return response()->json(['image' => $image_name ]);
    }
}
