<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class FeedbackController extends Controller
{
    public function index(){
        return view('feedback.add');
    }
    public function add(){

        $data=Input::all();
        $rules = array(
            'feedback_text' => 'required',
        );
        $validator = Validator::make($data,$rules);
        if ($validator->fails()){
            Session::flash('message',[
                'msg'=>"Something went wrong!!",
                'type'=>'alert-danger',
            ]);
        }
        else{
            Feedback::create(Input::all());
            Session::flash('message',[
                'msg' => 'Feedback Stored successfully.Thank you !!',
                'type' =>"alert-success"
            ]);
        }
        return Redirect::back();
    }
    public function view(){
        $data=Feedback::paginate(5);
        return view('feedback.view')->with('data',$data);
    }
}
