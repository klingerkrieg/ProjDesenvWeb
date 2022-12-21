<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    #as chaves estrangeiras das duas tabelas que estou ligando
    protected $fillable = ['post_id','category_id'];
}
