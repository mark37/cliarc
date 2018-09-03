<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'filename', 'mime', 'path', 'size', 'r_user_id', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
