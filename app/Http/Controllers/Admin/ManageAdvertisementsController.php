<?php


namespace App\Http\Controllers\admin;


use Illuminate\Http\Request;


use App\Http\Requests;


use App\Http\Controllers\Controller;


use App\Advertisement;


use App\AdvertisementAmount;


use App\AdvertisementType;


use App\Notifications;


use Auth;


class ManageAdvertisementsController extends Controller

{

    //

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function advertisements(Request $request)

    {


        $ads = Advertisement::whereIn( 'ad_status', [ 1, 4 ] )->get();


        return view( 'admin.advertisement', compact( 'ads' ) );

    }


    /**
     * @param Request $request
     * @param $ad
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function advertisement_view(Request $request, $ad)

    {


        $ad = Advertisement::leftJoin( 'users', 'advertisement.user_id', '=', 'users.id' )
            ->leftJoin( 'services', 'advertisement.service', '=', 'services.services_id' )
            ->select( 'advertisement.*', 'users.name', 'services.service as ad_service' )
            ->where( 'advertisement.id', $ad )->first();


        return view( 'modal-body.advertisement_view', compact( 'ad' ) );

    }


    /**
     * @param Request $request
     * @param $ad
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */

    public function change_ad_status(Request $request, $ad, $status)

    {


        $update = Advertisement::where( 'id', $ad )
            ->update( [ 'ad_status' => $status ] );


        $notito = Advertisement::where( 'id', $ad )->first();


        $notify_message = ($status == 1) ? " has activated your '" . $notito->ad_header . "' titled AD." : " has deactivated your '" . $notito->ad_header . "' titled AD.";


        Notifications::create( [

            'notify_action_id' => $ad,

            'notify_action_type' => 3,//provider ad

            'notify_action_from' => Auth::user()->id,

            'notify_action_to' => $notito->user_id,

            'notify_message' => $notify_message,

            'notify_status' => 2

        ] );


        $status = ($status == 1) ? "activated" : (($status == 4) ? "deactivated" : "status invalid");

        return redirect( 'admin/advertisements' )->with( 'success', 'success|Advertisement ' . $status );

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function setting(Request $request)
    {


        $amount = AdvertisementAmount::orderBy( 'updated_at', 'DESC' )->get();


        $ad_type = AdvertisementType::orderBy( 'updated_at', 'DESC' )->first();


        return view( 'admin.advertisement_setting', compact( 'amount', 'ad_type' ) );

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function advertisementsAmount(Request $request)
    {


        return view( 'modal-body.advertisement_amount' );

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */

    public function store(Request $request)

    {

        $output = "";


        if ( $request->ajax() ) {


            if ( $request->ad_amount ) {


                $requestData = $request->all();


                $requestData['ad_amount'] = conversion_to_cent( $requestData['ad_amount'] );


                $requestData['ad_type'] = $requestData['ad_type'];


                AdvertisementAmount::updateOrCreate( [ 'id' => $request->id ], $requestData );


                $amount = AdvertisementAmount::orderBy( 'updated_at', 'DESC' )->get();


                /* if ( $amount ) {


                     foreach ($amount as $key => $amount_list) {


                         $key_val = $key + 1;

                         $output .= '<tr>' .


                             '<td>' . $key_val . '</td>' .


                             '<td>' . ucfirst( conversion_to_pound( $amount_list->ad_amount ) ) . '</td>' .


                             '<td>' . $amount_list->updated_at . '</td>' .


                             '<td><a href="#" data-toggle="modal" data-target="#myModal" class="edit_ad_amount" data-id="' . $amount_list->id . '">Edit</a>

                                 </td>' .


                             '</tr>';


                     }

                 }

             } else {

                 $output = array (

                     'status' => 'empty',

                 );

             }*/

            }

        }

        return view('admin.ad_amount',compact('amount') );

    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function advertisementsUpdate($id)
    {


        $amount = AdvertisementAmount::where( 'id', $id )->first();


        return view( 'modal-body.advertisement_amount', compact( 'amount' ) );

    }


    /**
     * @param Request $request
     */

    public function advertisementsDays(Request $request)
    {


        $data = $request->all();

        $output = array ();


        if ( $data['ad_days'] == 'on' ) {

            $output['ad_days'] = '1';

            $output['ad_weeks'] = $data['ad_weeks'];


        }

        if ( $data['ad_weeks'] == 'on' ) {

            $output['ad_weeks'] = '1';

            $output['ad_days'] = $data['ad_days'];


        }

        AdvertisementType::create( $output );

        //return redirect('admin/advertisements/setting')

        // ->with('success','success|Setting is updated successfully');


    }
    public function destroy($id){
        AdvertisementAmount::where('id','=',$id )->delete();
        return redirect('admin/advertisements/setting')->with('success','success|Advertisement amount has been deleted.');
    }

}

