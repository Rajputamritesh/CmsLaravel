<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Categories\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index')->with('categories',category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'title'=>'required|unique:categories'

        ]);

        Category::create([

            'title'=>$request->title
              

        ]);
        session()->flash('success','Category created successfully');
return redirect(route('categories.index'));

     /* 
     old method
     
     $model=new Category();
       $model['title']=$request->name;
       $model['description']="hey its default";
       $model->save();
       return view('categories.index');*/
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
    public function edit(category $category)//reuest  name must be same as model name//it wil give all values of row with id 
    {

        //dd($category); 
        return view('categories.create')->with('category_row',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request,category $category)
    {
        $category['title']=$request->title;
        $category->save();
        session()->flash('success','Category updated successfully');
            return redirect(route('categories.index'));
    
            //return view('categories.index'); not working
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category_row)
    {
    //
    
    }

    public function del(category $category)
    {

        if($category->posts->count()>0)
        {
            session()->flash('error','Category  cannot be deleted as associated with some posts ');
        
            
            return redirect(route('categories.index')); 
        }
    else{
        $category->delete();
        session()->flash('success','Category deleted successfully');
        
        return redirect(route('categories.index'));
    }
    
    }
}
