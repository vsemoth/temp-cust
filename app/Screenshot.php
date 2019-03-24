<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    // Define Category - Screenshot relationship
    public function category()
    {
        $this->belongsTo('App\Category');
    }
}
