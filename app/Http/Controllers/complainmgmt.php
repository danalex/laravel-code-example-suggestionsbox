<?php

namespace App\Http\Controllers;

use App\Complain;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class complainmgmt extends Controller
{
    public function index(){
        return view('complain.add');
    }
    public function add(){

        $data=Input::all();
        $rules = array(
            'complain_text' => 'required',
        );
        $validator = Validator::make($data,$rules);
        if ($validator->fails()){
            Session::flash('message',[
                'msg'=>"Something went wrong!!",
                'type'=>'alert-danger',
            ]);
        }
        else{
            Complain::create(Input::all());
            Session::flash('message',[
                'msg' => 'Complain Stored successfully.Thank you!!',
                'type' =>"alert-success"
            ]);
        }
        return Redirect::back();
    }
    public function view(){
        $data=Complain::paginate(5);
        return view('complain.view')->with('data',$data);
    }
}
