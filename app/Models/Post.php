<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['text','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllPosts()
    {
        $sortBy = request()->sortBy;
        if ($sortBy) {
            return static::with('user')->orderBy($sortBy,'desc')->get();
        }
        return static::with('user')->get();
    }

}
