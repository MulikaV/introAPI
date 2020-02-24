<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['text','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getAllPosts(Request $request)
    {
        $sortBy = $request->sortBy;
        if ($sortBy) {
            return static::all()->sortByDesc($sortBy)->values();
        }
        return static::all();
    }

}
