<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    
    use SoftDeletes;
    
    protected $fillable = ['title','description','image','content','category_id','user_id']; 


public function category()
{
    return $this->belongsTo(Category::class);
}

public function tags()
{
    return $this->belongsToMany(tag::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}

}