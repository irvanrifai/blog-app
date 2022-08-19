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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    protected $guarded = [
        'id',
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

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    // public function post()
    // {
    //     return $this->belongsToMany(Post::class, 'saveds');
    // }

    // public function savedpost()
    // {
    //     return $this->belongsToMany(Post::class, 'saveds')->withPivot('id');
    // }

    public function saveds()
    {
        // parameter 1 (table yg mau dihubungkan)
        // parameter 2 (table pivot yg mau menghubungkan 2 tabel)
        // parameter 3 (variable FK pivot yang terhubung dengan tabel ini)
        // parameter 4 (variable FK pivot yg terhubung dengan tabel yang mau dihubungkan)
        // return $this->belongsToMany(Post::class, 'saveds', 'user_id', 'post_id');
        return $this->belongsToMany(Post::class, 'saveds', 'user_id', 'post_id')->withTimestamps();
    }
}
