<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Screenshot;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
    	// Fetch slug data from database
    	$post = Post::find(1);

    	// Return view with post object
    	return view('blog.single')->withPost($post);
    }

    public function getSingle($value='{slug}')
    {
        // Fetch slug data from database
        $post = Post::where('slug', '=', $value)->first();

        // Return view with post object
        return view('blog.single')->withPost($post);
    }

    public function getImage($value='{image_slug}')
    {
        // Fetch slug data from database
        $screenshot = Screenshot::where('image_slug', '=', $value)->first();

        // Return view with post object
        return view('blog.image')->withScreenshot($screenshot);
    }
}
