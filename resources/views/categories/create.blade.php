@extends('layouts.app')


@section('content')

<div class="row">
<div class="col l6 m6 s12 card" style="padding:40px">

<h5>Create Category </h5>

@if($errors->any())

    
<div class="alert alert-danger">
   
    
    <ul class="list-group">
    @foreach($errors->all() as $x)
    <li class="list-group-item text-danger">
    {{$x}}
    </li>
    @endforeach
       </ul>
  
  </div> 


@endif
<div class="form mt-2">
<form action="{{isset($category_row)?route('categories.update',$category_row):route('categories.store')}}"  method="post">
@csrf
@if(isset($category_row))

@method('PUT')


@endif
<div class="form-group card-content ">
<input  name="title" class="form-control" style="width:160px" placeholder="Enter title" value="{{isset($category_row)? $category_row->title :'' }}" type="text"/>
</div>
<div class="form-group">
<input type="submit" value="{{isset($category_row)?'update':'ADD'}}" class="btn btn-primary" >
</div>

</form>
</div>

</div>
</div>
@endsection