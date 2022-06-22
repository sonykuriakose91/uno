<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Jobs;
use App\Models\JobsImages;
use Illuminate\Support\Facades\DB;
use QrCode;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class JobsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Jobs::orderBy('id','DESC')->get();
    
        return view('jobs.index',compact('data'));
    }

    public function getjobsbystatus($job_status)
    {

        if($job_status == "draft") {

            $data = Jobs::where('job_status', 'Saved')->orderBy('id','DESC')->get();

        } elseif($job_status == "published") {

            $data = Jobs::where('job_status','Published')->orderBy('id','DESC')->get();

        } elseif($job_status == "seekquote") {

            $data = Jobs::where('job_status', 'Seek Quote')->orderBy('id','DESC')->get();

        } elseif($job_status == "completed") {

            $data = Jobs::where('job_status', 'Completed')->orderBy('id','DESC')->get();

        } elseif($job_status == "unpublished") {

            $data = Jobs::where('job_status', 'Unpublished')->orderBy('id','DESC')->get();

        } elseif($job_status == "rejected") {

            $data = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.status' => 1,'job_quotes.status' => 'Rejected'])->whereIn('jobs.job_status', ['Seek Quote','Ongoing','Published'])->distinct('jobs.id')->get();

        } elseif($job_status == "accepted") {

            $data = Jobs::select('jobs.*')->leftjoin('job_quotes','jobs.id', '=', 'job_quotes.job_id')->where(['jobs.status' => 1,'jobs.job_status' => 'Ongoing','job_quotes.status' => 'Accepted'])->orderBy('jobs.id','desc')->get();

        } elseif($job_status == "ongoing") {

            $data = Jobs::where('job_status', 'Ongoing')->orderBy('id','DESC')->get();

        } else {

            return abort(404);

        }
        
    
        return view('jobs.index',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jobs::with('jobimages','jobquotes')->where('id',$id)->firstOrFail();
        
        return view('jobs.view',compact('data'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Jobs::with('jobimages')->where('id',$id)->firstOrFail();
        
        if($job != "") {
            if($job->jobimages != "") {
                foreach($job->jobimages as $key => $image) {
                    if($image->job_image != "") {
                        unlink(public_path('uploads/jobs/'.$image->job_image));
                    }
                    $image->delete();
                }
            }
            
            $job->delete();
        }
    
        return redirect()->back()
                        ->with('danger','Job deleted successfully');
    }

    public function approve($id)
    {
        $data = Jobs::where('id',$id)->firstOrFail();

        $data->status = "Approved";
        $data->save();
        
        return redirect()->back()->with('success','Job approved successfully');
    }

    public function reject($id)
    {
        $data = Jobs::where('id',$id)->firstOrFail();

        $data->status = "Rejected";
        $data->save();
        
        return redirect()->back()->with('danger','Job rejected successfully');
    }

}
