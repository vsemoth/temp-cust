<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	// Define table
    protected $table = 'categories';

    // Protect fillable fields
    protected $fillable = ['category_name'];

    // Define relationship
    public function screenshots()
    {
    	$this->hasMany('App\Screenshot');
    }
}
