<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //protected $timestamps=['changed_at'];
	function user(){
		return $this->belongsTo('\App\User');
	}
}
