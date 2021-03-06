<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for videos
 */
class Video extends Model
{
    protected $table = 'video';
    protected $fillable = [
        'name', 'video', 'duration', 'public', 'fk_owner', 'author'
    ];
}
