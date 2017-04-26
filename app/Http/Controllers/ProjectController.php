<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
class ProjectController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function add()
	{
		return view('project.create');
	}
	public function  create(){
		$data = Input::all();
		$rules = array(
			'project_name' => 'required|unique:project',
		);
		$validator = Validator::make($data, $rules);
		if ($validator->fails()){
			return $validator->errors()->all();
		}
		else{
			Project::create(Input::all());
		}
		return;

	}
	public function view(){
		return Project::all();
	}
	public function delete($id){
		$project=Project::find($id);
		$project->delete();
		return Response::json(['msg'=>'Project Deleted Successfully']);
	}
	public function update(){
		$data = Input::all();
		$project=Project::findorfail(Input::get('project_id'));
		$rules = array(
			'project_name' => 'required|unique:project',
		);
		$validator = Validator::make($data, $rules);
		if ($validator->fails()){
			return $validator->errors()->all();
		}else{
			$project->update(Input::except('project_id'));
		}
		return;
	}
}
