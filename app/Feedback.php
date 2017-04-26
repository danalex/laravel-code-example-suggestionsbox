<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
        protected $table="feedback";
        protected $primaryKey='feedback_id';
        protected $fillable=[
            'feedback_text',
        ];
        public $timestamps=false;
}
