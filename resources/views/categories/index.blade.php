@extends('layouts.app')
@section('content')
<div class="justify-content-end mb-2 d-flex">
<a href=" categories/create" class="btn btn-success">Add Category</a>
</div>
<div class="card with-header" style="padding:10px">
<div class="card-heading ">
<h4>Categories<h4>
</div>
@if(session()->has('success'))
<div class="alert alert-success">
{{session()->get('success')}}
@endif
</div>
@if(session()->has('error'))
<div class="alert alert-danger">
{{session()->get('error')}}


</div>
@endif
<div class="card-body">
<table class="table table-striped ">
<thead>
<th>TITLE</th>
<th>No. Of Posts</th>
<th>Action</th>
</thead>
<tbody>
@foreach($categories as $category)
<tr>

            <td>
            {{$category->title}} 
            </td>
            <td>
            {{($category->posts->count())}}
            </td>
            <td>

            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-success ">Edit</a>
            <input type="button"  onclick="delete_category({{$category->id}})" class="btn btn-danger  mr-2" value="Delete"/>
            </td>
</tr>
@endforeach


<div class="modal fade" id="myModal" aria-labelledby="deleteModalLabel" aria-hidden="true" tabindex="-1" role="dialog">
  <div class = "modal-dialog" role="document">

<form action="" method="get" id="form_delete">

{{@csrf_field}}
{{method_field('delete')}}

    <div class="modal-content">
   
      <div class="modal-header">
        <h5 class="modal-title">DELETE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this model</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="form_delete" class="btn btn-danger" >Yes Delete</button>
      </div>
       
    </div>
  </form>
   
  </div>
</div>




</tbody>
</div>

 </div>      
</div>
@endsection

@section('script')
<script>
function delete_category(ide){
    
    var form=document.getElementById('form_delete');
    form.action="/cms/public/category/"+ide;
   console.log('form');
  
    $('#myModal').modal('show');console.log(form);

}
</script>

@endsection