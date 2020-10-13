<?php

namespace App\Handlers;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        $user = auth()->user();
        $admin=$user->hasRole('superadministrator|administrator');

	    if($admin){
	        return '/';
	    }else{
	        return '/'. auth()->user()->id;          
	    }
        // return parent::userField();
    }

}
