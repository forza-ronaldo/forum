<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable=['title','content','user_id','channel_id','slug'];
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function Channel()
    {
        return $this->belongsTo(Channels::class);
    }
    public function Replies()
    {
        return $this->hasMany(Reply::class);
    }
}
