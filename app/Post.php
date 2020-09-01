<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','body'];
    /*protected $hidden = ['title','body'];
    protected $appends = ['post_name','post_excerpt'];

    public function getPostNameAttribute(){
        return strtoupper($this->title);
    }

    public function getPostExcerptAttribute(){
        return strtoupper(substr($this->title,0,240).'...');
    }*/
}
