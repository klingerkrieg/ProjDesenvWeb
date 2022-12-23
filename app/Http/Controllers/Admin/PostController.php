<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller {

    public function list(Request $request){
        $pagination = Post::orderBy("subject");#->where('user_id',Auth::user()->id);

        if (isset($request->subject))
            #porcentagem faz com que busque por parte do texto
            $pagination->where("subject","like","%$request->subject%");
        if (isset($request->text))
            $pagination->where("text","like","%$request->text%");
        if (isset($request->publish_date))
            $pagination->whereDate("publish_date",$request->publish_date);

        #$pagination->dd();
        #$pagination->dump();
        return view("admin.posts.index", ["listaPaginada"=>$pagination->paginate(5)]);
    }

    public function create(){
        $categoryList = Category::all();
        return view("admin.posts.form",["data"=>new Post(),
                                        "categoryList"=>$categoryList]);
    }


    public function validator(Request $request){

        $rules = [
            'subject' => 'required|max:250',
            'publish_date' => 'required|date',
            'text' => 'required|max:8000',
        ];

        #somente obrigatório quando for um novo
        if ($request->method() == "POST"){
            $rules['image'] = 'required|image|max:1024';
        } else
        if ($request->method() == "PUT"){
            $rules['image'] = 'image|max:1024';
        }

        return Validator::make($request->all(), $rules);
    }

    private function armazenaImagem(Request $request){
        #SALVA A IMAGEM NA PASTA
        $data = $request->all();
        if ($request->file('image') != null){
            $path = $request->file('image')->store("posts","public");
            #nao pode setar o photo do $request, pois nao irá funcionar
            $data["image"] = $path;
        }
        return $data;
    }

    public function store(Request $request){

        #Valida todos os campos
        $validated = $this->validator($request)->validate();

        #Salva a imagem na pasta
        $data = $this->armazenaImagem($request);

        #Pega a id do usuario que está logado
        $data["user_id"] = Auth::user()->id;

        #Salva no banco
        $post = Post::create($data);

        #RELACIONAMENTO
        $category = Category::find($request["category_id"]);
        if ($category != null){
            CategoryPost::create(["post_id"=>$post->id,"category_id"=>$category->id]);
        }

        return redirect(route("post.edit", $post))->with("success",__("Data saved!"));
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect(route("post.list"))->with("success",__("Data deleted!"));
    }

    #abre o formulario de edição
    public function edit(Post $post){
        #Gate::authorize('update', $post);

        $categoryList = Category::all();


        $categories = Category::select("categories.*", "category_posts.id as category_posts_id")
                    ->join("category_posts","category_posts.category_id","=","categories.id")
                    ->where("post_id",$post->id)->paginate(2);#->dd(); se tiver duvida no sql, retire o paginate e deixe o dd()


        return view("admin.posts.form",["data"=>$post,
                                        "categories"=>$categories,
                                        "categoryList"=>$categoryList]);
    }

    #salva as edições
    public function update(Post $post, Request $request) {

        #Gate::authorize('update', $post);

        $validated = $this->validator($request)->validate();

        #Salva a imagem na pasta
        $data = $this->armazenaImagem($request);

        #Salva no banco
        $post->update($data);


        #RELACIONAMENTO
        $category = Category::find($request["category_id"]);
        if ($category != null){
            CategoryPost::create(["post_id"=>$post->id,"category_id"=>$category->id]);
        }

        return redirect()->back()->with("success",__("Data updated!"));
    }



}
