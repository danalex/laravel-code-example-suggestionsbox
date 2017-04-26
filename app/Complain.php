<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $table = 'complain';
    protected $primaryKey='complain_id';
    protected $fillable=[
        'complain_text',
    ];
    public $timestamps = false;
}
