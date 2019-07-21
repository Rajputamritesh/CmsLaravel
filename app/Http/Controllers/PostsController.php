<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\category;
use App\Tag; 
use App\http\Middleware\VerifyCategoriesCount;
use App\Http\Requests\Posts\StorePostsRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function __construct(){

        $this->middleware('VerifyCategoriesCount')->only(['create','store']);

      }  




    public function index()
    {
        return view(' posts.index')->with('posts',post::all())->with('categories',category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',category::all())->with('tags',tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostsRequest $request)
    {



        $image=$request->image->store('posts');
        
        $post=Post::create([

            'image'=>$image,
          
            'title'=>$request->title,
            'content'=>$request->content,
            'description'=>$request->description,
            'category_id'=>$request->category,
            'user_id'=>auth()->user()->id

        ]);

        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success','Posts created successfully');
        return redirect(route('posts.index'));


     /*   Category::create([

            'title'=>$request->title,
              'Description'=>$request->description,
              'Content'=>$request->content,
              'image'=>$request->image,
              'published_at'=>$request->published_at

        ]);
        session()->flash('success','Category created successfully');
return redirect(route('categories.index'));*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post_row',$post)->with('categories',category::all())->with('tags',tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostsRequest $request,post $post)
    {
       
           

            $image=$request->image->store('posts');
            
            storage::delete($post->image);

       
      

        $post->title=$request->title;
        $post->content=$request->content;
        $post->description=$request->description;
        $post->published_at=$request->published_at;
        $post->title=$request->title;
        $post->category_id=$request->category;
        
        $post->image=$image;
        $post->save();
      
        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }

        session()->flash('success','post updated successfully');
        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post=Post::withTrashed()->where('id',$id)->firstorfail();    
        
        if($post->trashed())
        {
            Storage::delete($post->image);
            $post->forceDelete();//permanantly delete
        }
        else{
            $post->delete();//trash
        }
        session()->flash('error','Posts deleted successfully');
        return redirect(route('posts.index'));                   //this will notdelete permanently
    
    
    }                                                            //as we are using soft delete 
  


    public function trash()
    {

    $trashed=Post::onlyTrashed()->get();//al trashed files

       
    return view(' posts.index')->with('posts',$trashed);
    
    }

    public function restore($id)
    {

        $post=Post::withTrashed()->where('id',$id)->firstorfail(); 
        
        $post->restore();

       
        session()->flash('success','Posts restored successfully');
        return redirect(route('posts.index'));   
    
    }


}
