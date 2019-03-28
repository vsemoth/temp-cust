<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	// Define table
    protected $guarded = [];

    // Define relationship
    public function screenshots()
    {
    	return $this->hasMany('App\Screenshot');
    }
}
