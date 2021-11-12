<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'comment', 'reply_id'];

    public function replies()
    {
        return $this->hasMany('App\Comment','id','reply_id');
    }
}
