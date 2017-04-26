<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report_content extends Model
{
    protected $table='report_content';
	protected $fillable=[
		'report_id','project_id','subject','percentage','status','notes','label','ticket_id'
	];
	protected $appends=array('project_name','status_value');
	public $timestamps=false;

	public function getStatusValueAttribute(){
		if($this->status==1){
			return 'In Progress';
		}else{
			return 'Done';
		}
	}
	public function getProjectNameAttribute() {
		$p_name = null;
		if ($this->project) {
			$p_name = $this->project->project_name;
		}
		return $p_name;
	}
	public function report()
	{
		return $this->hasMany('App\report','report_id','report_id');
	}
	public function project(){
		return $this->belongsTo('App\Project','project_id','project_id');
	}
}
