<?php



namespace App\Http\Controllers\Prescriber;



use App\Http\Controllers\Controller;



use Illuminate\Http\Request;



use Auth;



use App\ProviderGallery;



class ProviderGalleryController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //

        $status = array("1"=>"Active","0"=>"In-active");

        $gallery = ProviderGallery::where('user_id',Auth::user()->id)->get();

        $galleryCount = $gallery->count();



        return view('provider.gallery',compact('gallery','status','galleryCount'));



    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

         return view('provider.create_edit_gallery');

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {



       /*if($request->file('file'))

        {

            $image = $request->file('file');



            $imageName = time().'.'.$image->getClientOriginalExtension();



            $image->move(public_path('uploads/gallery/'),$imageName);



            ProviderGallery::insert([



                "user_id"   => Auth::user()->id,

                "file_name" => $imageName,

                "extension" => $image->getClientOriginalExtension(),

                'status'    => 1,

                "created_at" => date("Y-m-d H:i:s")

            ]);



        }*/

        if($request->hasFile('gallery')) {

            $image = $request->file('gallery');
            $imageName = 'ORG_'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery/original/'),$imageName);

            ProviderGallery::where('id','=',$request->id)->update(['original_path' => $imageName]);
        }


        return response()->json(['success'=>$imageName]);

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
        $gallery_files = ProviderGallery::where('id', $id)->first();

        return view('provider.addedit_gallery',compact('gallery_files'));
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

        //

        //=======================================================validation

          //   $this->validate($request,[

          //    'gallery'=>'required',

          //    'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'

          // ]);

        //================================================================



        if($request->hasFile('gallery')) {

            $image = $request->file('gallery');
            $imageName = 'ORG_'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery/original/'),$imageName);
        }

        $service = ProviderGallery::where('id', $id)->update(['original_path' => $imageName]);

        return redirect('provider/gallery')->with('success','success|Image updated successfully');
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

        $res = ProviderGallery::where('id', $id)->delete();

        return redirect('provider/gallery')->with('success','success|File deleted successfully');

    }

}

