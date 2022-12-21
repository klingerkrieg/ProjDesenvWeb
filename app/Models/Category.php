<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["name"];

    public function posts(){
                    #pertence a muitos
        return $this->belongsToMany(Post::class, "category_posts");
    }


}
