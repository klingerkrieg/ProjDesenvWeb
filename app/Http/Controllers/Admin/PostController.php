<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller {

    public function list(Request $request){
        return view("admin.posts.index", ["list"=>Post::paginate(3)]);
    }

    public function create(){
        return view("admin.posts.form");
    }

    public function store(Request $request){
        Post::create($request->all());
        return redirect()->back()->with("success","Data saved!");
    }
    
}
