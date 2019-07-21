@extends('layouts.app')


@section('content')

<div class="card with-header" style="padding:10px">
<div class="card-heading ">
<h4>Users<h4>
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
<th>Image</th>
<th>UserName</th>
<th>Email</th>
<th>Role</th>
</thead>
<tbody>
@foreach($users as $user)
<tr>

            <td>
            <img style="border-radius:40px" src="{{Gravatar::src($user->email)}}">
            </td>
            <td>
           {{$user->name}}
            </td>
            <td>
            {{$user->email}}
            </td>
            <td>
            {{$user->role}}
            </td>
            @if($user->role=='writer')
            <td>
            <form action="{{route('change.role',$user->id)}}"  method="post">
            
@csrf

                <button type="submit" class="btn btn-primary">Make Admin</button>
            
            
            </form>
            </td>
            @endif
</tr>
@endforeach


</tbody>
</div>

 </div>      
</div>
@endsection

@section('script')
<script>

</script>

@endsection
