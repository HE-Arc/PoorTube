<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for Likes
 */
class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id', 'video_id'];
}
