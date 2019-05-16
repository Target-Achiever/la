<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Http\Request;



use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Disclaimer;

class DisclaimerController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        if($request->id) {

            $disclaimer_array = Disclaimer::find($request->id);

        }

        $disclaimer=Disclaimer::orderBy('updated_at', 'DESC')->get();

        $types = array("1" => "Disclaimer","2" => "Terms & Condition","3" => "Privacy & Policy");



        return view('admin.disclaimer',compact('disclaimer_array','disclaimer','types'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function disclaimer_save(Request $request)

    {

        $this->validate($request, [

            'disclaimer' => 'required'

        ]);

        Disclaimer::create($request->all());

        return redirect('admin/disclaimer')



            ->with('success','success|Disclaimer created successfully');

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

        //

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

        $this->validate($request, [

            'disclaimer' => 'required',

        ]);



        Disclaimer::find($id)->update($request->all());



        return redirect('admin/disclaimer')



            ->with('success','success|Disclaimer updated successfully');

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

