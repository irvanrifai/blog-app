<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\{Auth, DB, Storage, Gate};

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function user()
    // {
    //     return $this->belongsToMany(User::class, 'saveds');
    // }

    // public function savedpost()
    // {
    //     return $this->belongsToMany(User::class, 'saveds')->withPivot('post_id');
    // }
    public function saveds()
    {
        // parameter 1 (table yg mau dihubungkan)
        // parameter 2 (table pivot yg mau menghubungkan 2 tabel)
        // parameter 3 (variable FK pivot yang terhubung dengan tabel ini)
        // parameter 4 (variable FK pivot yg terhubung dengan tabel yang mau dihubungkan)
        // return $this->belongsToMany(User::class, 'saveds', 'post_id', 'user_id');
        // return $this->belongsToMany(User::class, 'saveds', 'post_id', 'user_id')->withTimestamps()->withPivot('user_id', 'post_id');
        return $this->belongsTo(Saved::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
