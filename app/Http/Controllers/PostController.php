<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {


    public function index(Request $request)	{
		return view("post");
	}

    public function get(Post $post){
        return view("post",["post"=>$post]);
    }



}
