
@extends('layouts.app')




@section('content')


<div class="row">
@if(session()->has('success'))
<div class="alert alert-success">
{{session()->get('success')}}

</div>

@endif

@if(session()->has('error'))
<div class="alert alert-danger">
{{session()->get('error')}}

</div>

@endif

<div class="col l6 m6 s12 card" style="padding:40px">


@if(isset($post_row))

<h5>Update Post </h5>


@endif
@if(!isset($post_row))
<h5>Create Post </h5>
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



<div class="form ">
<form action="{{isset($post_row)?route('posts.update',$post_row):route('posts.store')}}"  method="post"   enctype="multipart/form-data">
@csrf
@if(isset($post_row))

@method('PUT')


@endif
<div class="form-group  ">
<label for="title">Title</label>
<input  name="title" class="form-control" placeholder="Enter title" value="{{isset($post_row)? $post_row->title :'' }}" type="text"/>
</div>
<div class="form-group  ">
<label for="Description">Description</label>
<textarea name="description" rows="5"  class="form-control" cols="5" id="description">
{{isset($post_row)? $post_row->description :'' }}
</textarea></div>
<div class="form-group  ">
<label for="Content">Content</label>
<textarea name="content" rows="5"  class="form-control" cols="5" id="content">{{isset($post_row)? $post_row->content :'' }}</textarea></div>

<div class="form-group  ">
<label for="category">Category</label>

<select name="category" id="category" class="form-control">
@foreach($categories as $x)
<option value="{{$x->id}}"

@if(isset($post_row))
  @if($x->id==$post_row->category_id)

  selected
  @endif


@endif>

{{$x->title}}


</option>
@endforeach
</select>
</div>

<div class="form-group>">
<label for="tags">tags</label>
@if($tags->count()>0)
<select name="tags[]" id="tags"  class="selecto form-control" multiple>


@foreach($tags as $x)
<option value="{{$x->id}}"

<?php 
if(isset($post_row))
{
  
 if(in_array($x->id,$post_row->tags->pluck('id')->toArray()))
 {
 ?>

selected
<?php
 }
}
?> >

{{$x->name}}


</option>
@endforeach


</select>
@endif

@if(isset($post_row))
<div class="form-group">
<img src="../../storage/<?php echo $post_row['image']?>"  alt="img" style="width:100%"/>

</div>
@endif


<div class="form-group ">
<label for="image">IMAGE</label><br>
<input type="file"  name="image" id="image"></div>
<div class="form-group  ">
<label for="published_at">Published At</label><br>
<input type="text"  name="published_at" id="published_at"></div>
<div class="form-group">
<input type="submit"  value="{{isset($post_row)? 'Update' :'Create' }}" class="btn btn-primary" >
</div>

</form>
</div>

</div>
</div>


@endsection
@section('scripts')
 <!-- Here you call the select2 js plugin -->
<script>
 $(document).ready(function() {
    $('.selecto').select2();
});
</script>

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

</script>

@endsection