<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    public function list(Request $request){
        $pagination = User::orderBy("name");

        if (isset($request->name))
            #porcentagem faz com que busque por parte do texto
            $pagination->where("name","like","%$request->name%");
        if (isset($request->email))
            $pagination->where("email","like","%$request->text%");

        return view("admin.users.index", ["listaPaginada"=>$pagination->paginate(5)]);
    }

    public function create(){
        return view("admin.users.form",["data"=>new User()]);
    }


    public function validator(Request $request){

        $rules = [
            'name'          => 'required|max:250',
            'email'         => 'required|email',
            "cep"           => "regex:/[0-9]{5}\-[0-9]{3}/",
            "number"        => "required|string",
            "street"        => "required|string",
            "complement"    => "nullable|string",
            "district"      => "required|string",
            "city"          => "required|string",
            "state"         => "required|string",
        ];

        return Validator::make($request->all(), $rules);
    }


    public function store(Request $request){

        #Valida todos os campos
        $validated = $this->validator($request)->validate();

        #Salva no banco
        $data = $request->all();
        $obj = User::create($data);


        #salvar o endereço
        $validated["user_id"] = $obj->id;
        Address::updateOrCreate($validated);


        return redirect(route("user.edit", $obj))->with("success",__("Data saved!"));
    }

    public function destroy(User $user){
        $user->delete();
        return redirect(route("user.list"))->with("success",__("Data deleted!"));
    }

    #abre o formulario de edição
    public function edit(User $user){

        $posts = Post::where("user_id",$user->id)->paginate(2);

        return view("admin.users.form",["data"=>$user, "posts"=>$posts]);
    }

    #salva as edições
    public function update(User $user, Request $request) {
        $validated = $this->validator($request)->validate();

        #Salva no banco
        $data = $request->all();
        $user->update($data);

        #salvar o endereço
        $validated["user_id"] = $user->id;
        Address::updateOrCreate($validated);

        return redirect()->back()->with("success",__("Data updated!"));
    }



}
