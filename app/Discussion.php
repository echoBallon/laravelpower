<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    //
    protected $fillable = ['title','body','user_id','last_user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * 一个帖子一个人发布的
     */
    public function user(){
       return $this->belongsTo(User::class);
    }

    public  function comments(){
        return $this->hasMany(Comment::class);
    }
}
