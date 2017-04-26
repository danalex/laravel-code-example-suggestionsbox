<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = 'project';
	protected $primaryKey='project_id';
	protected $fillable=[
		'project_name',
		'start_date','end_date'
	];
	public $timestamps = false;

	public function report_content(){
		return $this->hasMany('App\report_content','project_id');
	}
}
