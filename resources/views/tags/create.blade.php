@extends('layouts.app')


@section('content')

<div class="row">
<div class="col l6 m6 s12 card" style="padding:40px">


@if(isset($tag_row))

<h5>Update Tag </h5>
@else
<h5>Create Tag </h5>
@endif

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
<form action="{{isset($tag_row)?route('tags.update',$tag_row):route('tags.store')}}"  method="post">
@csrf
@if(isset($tag_row))

@method('PUT')


@endif
<div class="form-group card-content ">
<input  name="name" class="form-control" style="width:160px" placeholder="Enter name" value="{{isset($tag_row)? $tag_row->title :'' }}" type="text"/>
 </div>
<div class="form-group">
<input type="submit" value="{{isset($tag_row)?'update':'ADD'}}" class="btn btn-primary" >
</div>

</form>
</div>

</div>
</div>
@endsection