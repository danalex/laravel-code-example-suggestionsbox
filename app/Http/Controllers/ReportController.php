<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use Illuminate\Support\Facades\Auth;
use App\report;
use App\report_content;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class ReportController extends Controller
{
	public function __construct()
	{
		//$this->middleware('auth');
	}
	public function add()
	{
		return view('report.create',['project'=>Project::all()]);
	}
	public function  create(){
		$data=Input::all();
		$rules=array(
			'report_name'=>'required|unique:report',
		);
		$validator=Validator::make($data,$rules);
		if($validator->fails()){
			return $validator->errors()->all();
		}else{
			Report::create($data);
		}
		return;
	}
	public function createcontent(){
		$data=Input::all();
		$rules=array(
			'report_id'=>'required',
			'project_id'=>'required',
			'subject'=>'required',
			'notes'=>'required',
		);
		$validator=Validator::make($data,$rules);
		if($validator->fails()){
			return $validator->errors()->all();
		}else{
			Report_content::create($data);
		}
		return;
	}
	public function view($report_id){
		$user = Auth::user();
		$user_id = $user->id;
		return Report::with('report_content')->where('report_id',$report_id)->where('user_id',$user_id)->get()->toArray();
	}
	public function  getall(){
		$user = Auth::user();
		$user_id = $user->id;
		return Report::where('user_id',$user_id)->get();
	}
	public  function  viewbydate($date){
		$user=Auth::user();
		$user_id=$user->id;
		return Report::with('report_content')->where('report_date',$date)->where('user_id',$user_id)->get()->toArray();
	}
	public  function  getview(){
		return view('report.view',['report'=>report::where('user_id',Auth::user()->id)]);
	}
	public function show($date,$user_id){
		$data=Report::with('report_content')->where('report_date',$date)->where('user_id',$user_id)->get();
		if(count($data)>0)
			return view('report.show',['report'=>$data]);
		else
			return Redirect::to('/');
	}
	public function show2($report_id,$user_id){
		$data=Report::with('report_content')->where('report_id',$report_id)->where('user_id',$user_id)->get();
		if(count($data)>0)
				return view('report.show',['report'=>$data]);
		else
			return Redirect::to('/');
	}
}
