<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getSingle($value='{slug}')
    {
    	// Fetch slug data from database
    	$post = Post::where('slug', '=', $value)->first();

    	// Return view with post object
    	return view('blog.single')->withPost($post);
    }
}
