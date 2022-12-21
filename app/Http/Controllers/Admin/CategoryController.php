<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {

    public function list(Request $request){
        $pagination = Category::orderBy("name");

        if (isset($request->name))
            #porcentagem faz com que busque por parte do texto
            $pagination->where("name","like","%$request->name%");

        return view("admin.categories.index", ["listaPaginada"=>$pagination->paginate(5)]);
    }

    public function create(){
        $postsList = Post::all();
        return view("admin.categories.form",["data"=>new Category(),
                                            "postsList"=>$postsList]);
    }


    public function validator(Request $request){

        $rules = [
            'name' => 'required|max:250',
            'post_id' => 'exclude_if:post_id,null|exists:posts,id',
        ];

        return Validator::make($request->all(), $rules);
    }


    public function store(Request $request){

        #Valida todos os campos
        $validated = $this->validator($request)->validate();

        #Salva no banco
        $data = $request->all();
        $obj = Category::create($data);
        return redirect(route("category.edit", $obj))->with("success",__("Data saved!"));
    }

    public function destroy(Category $category){
        $category->delete();
        return redirect(route("category.list"))->with("success",__("Data deleted!"));
    }

    #abre o formulario de edição
    public function edit(Category $category){
        $postsList = Post::all();


        #se achar muito complicado, faça dessa forma
        #$posts = $category->posts;

        #category
        #    category_posts (Só estou incluindo essa e a tabela posts)
        #posts

        $posts = Post::select("posts.*", "category_posts.id as category_posts_id")
                    ->join("category_posts","category_posts.post_id","=","posts.id")
                    ->where("category_id",$category->id)->paginate(2);#->dd(); se tiver duvida no sql, retire o paginate e deixe o dd()

        return view("admin.categories.form",["data"=>$category,
                                            "postsList"=>$postsList, #sao todos os posts, para serem vinculados
                                            "posts"=>$posts]); #apenas os posts que estão vinculados
    }

    #salva as edições
    public function update(Category $category, Request $request) {
        $validated = $this->validator($request)->validate();

        #Salva no banco
        $data = $request->all();
        $category->update($data);

        #RELACIONAMENTO
        $post = Post::find($request["post_id"]);
        if ($post != null){
            #na documentação consta esse método
            #funciona, mas não insere os timestamps
            #$category->posts()->attach($post);
            CategoryPost::create(["post_id"=>$post->id,"category_id"=>$category->id]);
        }

        return redirect()->back()->with("success",__("Data updated!"));
    }


    public function desvincular(CategoryPost $category_post){
        $category_post->delete();
        return redirect()->back()->with("success",__("Data deleted!"));
    }




}
