<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class report extends Model
{
	protected $table='report';
	protected $primaryKey='report_id';
	protected $fillable=[
	'report_date','user_id','report_name'
	];
	public $timestamps = false;
	public function report_content()
	{
		return $this->hasMany('App\report_content','report_id','report_id');
	}

}
