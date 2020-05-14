<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channels extends Model
{
    protected $fillable=['title'];
    public function Discussions()
    {
        return $this->hasMany(Discussion::class,'channel_id');
    }
}
