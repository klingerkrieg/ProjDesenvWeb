<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    const ADMIN_LEVEL = 30;
    const AUTHOR_LEVEL = 20;
    const DEFAULT_LEVEL = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Relacionamento
     * UM para MUITOS
     */
    public function posts(){
                    # temMuitos
        return $this->hasMany(Post::class);
    }

    public function address(){
                    #hasOne
        return $this->hasOne(Address::class);
    }


    public function isAdministrator(){
        return $this->level == User::ADMIN_LEVEL;
    }

}
