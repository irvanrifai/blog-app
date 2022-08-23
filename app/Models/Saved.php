<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    use HasFactory;
    protected $guarded = [
        'id',
    ];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function post()
    {
        // return $this->belongsToMany(Post::class);
        return $this->hasMany(Post::class);
    }
}
