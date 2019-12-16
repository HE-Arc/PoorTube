<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model class for comments
 */
class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'user_id', 'video_id', 'user_name', 'comment'
    ];
}
