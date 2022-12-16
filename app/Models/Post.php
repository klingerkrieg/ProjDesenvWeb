<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model {
    #SoftDeletes exclusão lógica (não deleta de verdade)
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "publish_date",
        "image",
        "subject", #assunto
        "text",
        "slug",
        "user_id"
    ];

    protected $dates = [
        "publish_date"
    ];


    /**
     * Relacionamento
     * MUITOS para UM
     */
    public function user(){
                    #pertenceA
        return $this->belongsTo(User::class);
    }



    #               set[NOMEDOATRIBUTO]Attribute

    public function setSubjectAttribute($subject){
        #seta o subject normalmente
        $this->attributes["subject"] = $subject;


        if ($this->slug != "")
                return;#evitar que seja alterado


        #criar um novo slug
        $post = Post::withTrashed()#pega até os deletados
                    ->orderByDesc("id")
                    ->first();

        $id = "";
        if ($post){
            $id = "_".($post->id + 1);
        }

        #assunto:Computadores atuais da modernidade moderna
        #slug:computadores-atuais-da-modernidade-moderna
        $this->attributes["slug"] = Str::slug($subject).$id;
    }


}
