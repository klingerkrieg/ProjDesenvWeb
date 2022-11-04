<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller {

    public function list(Request $request){
        return view("admin.posts.index", ["listaPaginada"=>Post::paginate(3)]);
    }

    public function create(){
        return view("admin.posts.form",["data"=>new Post()]);
    }


    public function validator(array $data){
        return Validator::make($data, [
            'subject' => 'required|max:250',
            'publish_date' => 'required|date',
            'text' => 'required|max:8000',
            'slug' => 'required',#por enquanto
            'image' => 'required',#por enquanto
        ]);
    }

    public function store(Request $request){
        $validated = $this->validator($request->all())->validate();
        $obj = Post::create($request->all());
        return redirect(route("post.edit", $obj))->with("success",__("Data saved!"));
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route("post.list"))->with("success",__("Data deleted!"));
    }

    #abre o formulario de edição
    public function edit(Post $post){
        return view("admin.posts.form",["data"=>$post]);
    }

    #salva as edições
    public function update(Post $post, Request $request) {
        $validated = $this->validator($request->all())->validate();
        $post->update($request->all());
        return redirect()->back()->with("success",__("Data updated!"));
    }



}
