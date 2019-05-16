<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;


use App\Http\Requests;

use App\Http\Controllers\Controller;

use Auth;

use App\About;

class AboutController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()

    {

        $about = About::where( 'about_status', '=', '1' )->get();


        return view( 'admin.manage_about', compact( 'about' ) );

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()

    {

        return view( 'admin.create_edit_about' );

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)

    {

        $this->validate( $request, [

            'about_header' => 'required',

            'about_content' => 'required',

            'about_banner' => 'required',

            'about_readmore' => 'required',

        ] );


        $user_id = Auth::user()->id;

        $inputs = $request->all();


        if ( isset( $inputs['about_header'] ) ) {


            $data['about_header'] = $inputs['about_header'];

            $data['about_content'] = $inputs['about_content'];

            $data['about_readmore'] = $inputs['about_readmore'];

            $data['about_status'] = '1';


            if ( $request->hasFile( 'about_banner' ) ) {


                $file = $request->file( "about_banner" );

                $photo = $user_id . "_" . time() . '.' . $file->getClientOriginalExtension();

                $data['about_banner'] = $photo;

                $file->move( public_path( 'uploads/about_banner' ), $photo );

            }


            About::create( $data );


        }

        return redirect( 'admin/about' )
            ->with( 'success', 'success|About created successfully' );


    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)

    {

        //

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)

    {

        $about = About::find( $id );


        return view( 'admin.create_edit_about', compact( 'about' ) );

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)

    {

        $this->validate( $request, [

            'about_header' => 'required',

            'about_content' => 'required',

            'about_readmore' => 'required',

        ] );

        $data = $request->all();

        $about = About::where( 'id', $id )->first();

        $user_id = Auth::user()->id;


        if ( $request->hasFile( 'about_banner' ) ) {

            $file = $request->file( "about_banner" );

            $photo = $user_id . "_" . time() . '.' . $file->getClientOriginalExtension();

            $file->move( public_path( 'uploads/about_banner' ), $photo );

        } else {

            $photo = $about->about_banner;

        }


        About::where( 'id', $id )->update( [

            'about_header' => $data['about_header'],

            'about_content' => $data['about_content'],

            'about_banner' => $photo,

            'about_readmore' => $data['about_readmore'],

        ] );


        return redirect( 'admin/about' )
         ->with( 'success', 'success|About content updated successfully' );

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)

    {

        //

    }

}

