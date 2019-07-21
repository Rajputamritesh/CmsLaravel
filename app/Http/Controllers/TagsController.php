<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index')->with('tags',tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'name'=>'required|unique:tags'

        ]);

        tag::create([

            'name'=>$request->name
              

        ]);
        session()->flash('success','tag created successfully');
return redirect(route('tags.index'));

     /* 
     old method
     
     $model=new tag();
       $model['name']=$request->name;
       $model['description']="hey its default";
       $model->save();
       return view('tags.index');*/
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
    public function edit(tag $tag)//reuest  name must be same as model name//it wil give all values of row with id 
    {

       // dd($tag->name); 
        return view('tags.create')->with('tag_row',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request,tag $tag)
    {
        $tag['name']=$request->name;
        $tag->save();
        session()->flash('success','tag updated successfully');
            return redirect(route('tags.index'));
    
            //return view('tags.index'); not working
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(tag $tag_row)
    {
    //
    
    }

    public function del(tag $tag)
    {
    if($tag->posts->count())
    {
        session()->flash('error','tag  cannot be deleted as associated with some posts ');
        
            
        return redirect(route('tags.index')); 

    }else{
        $tag->delete();
        session()->flash('success','tag deleted successfully');
        
        return redirect(route('tags.index'));

    }
    
    }
}
