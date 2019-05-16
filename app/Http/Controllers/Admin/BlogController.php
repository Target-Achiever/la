<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $blog = Blog::where( 'blog_status', '=', '1' )->get();

        return view( 'admin.manage_blog', compact( 'blog' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'admin.create_edit_blog' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [

            'blog_header' => 'required',

            'blog_content' => 'required',

            'blog_banner' => 'required',

        ] );


        $user_id = Auth::user()->id;

        $inputs = $request->all();

        if ( isset( $inputs['blog_header'] ) ) {


            $data['blog_header'] = $inputs['blog_header'];

            $data['blog_content'] = $inputs['blog_content'];

            $data['blog_status'] = '1';


            if ( $request->hasFile( 'blog_banner' ) ) {


                $file = $request->file( "blog_banner" );

                $photo = $user_id . "_" . time() . '.' . $file->getClientOriginalExtension();

                $data['blog_banner'] = $photo;

                $file->move( public_path( 'uploads/blog_banner' ), $photo );

            }


            Blog::create( $data );


        }

        return redirect( 'admin/blog' )
            ->with( 'success', 'success|Blog created successfully' );
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
        $blog = Blog::find( $id );


        return view( 'admin.create_edit_blog', compact( 'blog' ) );

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
        $this->validate( $request, [

            'blog_header' => 'required',

            'blog_content' => 'required',

        ] );

        $data = $request->all();

        $blog = Blog::where( 'id', $id )->first();

        $user_id = Auth::user()->id;


        if ( $request->hasFile( 'blog_banner' ) ) {

            $file = $request->file( "blog_banner" );

            $photo = $user_id . "_" . time() . '.' . $file->getClientOriginalExtension();

            $file->move( public_path( 'uploads/blog_banner' ), $photo );

        } else {

            $photo = $blog->blog_banner;

        }


        Blog::where( 'id', $id )->update( [

            'blog_header' => $data['blog_header'],

            'blog_content' => $data['blog_content'],

            'blog_banner' => $photo,


        ] );


        return redirect( 'admin/blog' )
            ->with( 'success', 'success|Blog content updated successfully' );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Blog::findOrFail($id);
        $item->delete();

        return redirect( 'admin/blog' )
            ->with( 'success', 'success|Blog content deleted successfully' );

    }
}
