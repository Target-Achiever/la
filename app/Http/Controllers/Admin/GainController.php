<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;



use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\GainProvider;

use Illuminate\Support\Facades\Auth;



class GainController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $gain = GainProvider::orderBy('created_at','DESC')->get();



        return view('admin.gain',compact('gain'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('admin.create_edit_gain');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $this->validate($request,[

            'header'=>'required',

            'content'=>'required',

            'gain_banner'=>'required',

            'forward_link'=>'required',

        ]);



        $inputs = $request->all();



        if(isset($inputs['header'])) {



            $data['header'] = $inputs['header'];

            $data['content'] = $inputs['content'];

            $data['forward_link'] = $inputs['forward_link'];

            $data['status'] = '1';



            if ( $request->hasFile( 'gain_banner' ) ) {

                $file = $request->file( "gain_banner" );

                $photo = time() . '.' . $file->getClientOriginalExtension();

                $data['gain_banner'] = $photo;

                $file->move( public_path( 'uploads/gain_banner' ), $photo );

            }



            GainProvider::create($data);



        }

        return redirect('admin/gain')
            ->with('success','success|Gain provider has created successfully');

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

        $gain = GainProvider::find($id);

        return view('admin.create_edit_gain',compact('gain'));

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

        $this->validate($request,[

            'header'=>'required',

            'content'=>'required',

            'forward_link'=>'required|url',

        ]);



        $user_id = Auth::user()->id;

        $inputs = $request->all();

        $data['header'] = $inputs['header'];

        $data['content'] = $inputs['content'];

        $data['forward_link'] = $inputs['forward_link'];

        $data['status'] = '1';





        if ( $request->hasFile( 'gain_banner' ) ) {

            $file = $request->file( "gain_banner" );

            $photo = time() . '.' . $file->getClientOriginalExtension();

            $data['gain_banner'] = $photo;

            $file->move( public_path( 'uploads/gain_banner' ), $photo );

        }else{

            $banner = GainProvider::where('id',$id)->first();

            $data['gain_banner'] = $banner['gain_banner'];

        }



        GainProvider::where('id',$id)->update($data);

        return redirect('admin/gain')
            ->with('success','success|Gain provider has updated successfully');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

    }

}

