<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable=['user_id','discussion_id','text'];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Discussion()
    {
        return $this->belongsTo(Discussion::class);
    }
}
