<?php

namespace App\Http\Controllers\Blog;
use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
        public function show(Post $post){
           
        return view('blog.show')->with('post_row',$post);

        }





}
