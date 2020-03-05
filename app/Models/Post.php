<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 * @property int id
 * @property int user_id
 * @property string text
 */
class Post extends Model
{
    protected $fillable = ['body'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
