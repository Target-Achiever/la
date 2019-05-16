<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Feedback;

class ManageFeedbacksController extends Controller
{
    //

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function feedbacks()
    {

    	$feedbacks = Feedback::leftJoin('users','feedback.user_id','=','users.id')
            ->join('users as provider','feedback.provider_id','=','provider.id')
            ->select('users.name','users.photo','feedback.*','provider.name as provider')
            ->orderBy('id', 'desc')
            ->paginate(10);

    	return view('admin.manage_feedbacks',compact('feedbacks'));
    	
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view_user_feedback($id)
    {

    	$feedback = Feedback::leftJoin('users','feedback.user_id','=','users.id')
                                ->select('users.name','users.photo','feedback.*')
                                ->where('feedback.id','=',$id)->first();

        // print_r($feedback);die;
        return view('modal-body.user_feedback_Sadmin',compact('feedback'));                        

    }

    /**
     * @param Request $request
     * @param $feedbackid
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change_feedback_status(Request $request, $feedbackid, $status)
    {
    	// echo $feedbackid."***".$status;die;
    	$update = Feedback::where('id',$feedbackid)->update(['status' => $status]);

    	$status = ($status ==1) ? "approved" : "rejected";
    	return redirect('/admin/feedbacks')->with('success','success|Feedback '.$status);
    }

    /**
     * @param Request $request
     * @param $feedbackid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove_feedback(Request $request, $feedbackid)
    {
    	$delete = Feedback::where('id',$feedbackid)->delete();

    	return redirect('/admin/feedbacks')->with('success','success|Feedback removed successfully');
    }
}
