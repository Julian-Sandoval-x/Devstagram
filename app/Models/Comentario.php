<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable('comentario', 'user_id', 'post_id')]
class Comentario extends Model
{
    //

    public function user() {
        return $this->belongsTo(User::class)->select(['username']);
    }
}
