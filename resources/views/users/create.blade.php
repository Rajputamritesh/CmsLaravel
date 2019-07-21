@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                <div class="form ">
<form action=" {{route('users.update',$user->id)}}"  method="post" >
@csrf



<div class="form-group  ">
<label for="name">Name</label>
<input  name="name" class="form-control" placeholder="" value="{{ $user->name }}" type="text"/>
</div>

<div class="form-group  ">
<label for="Email">Email</label>
<input  name="email" class="form-control" placeholder="" value="{{ $user->email }}" type="text"/>
</div>
<div class="form-group  ">
<button  type="submit" name="update" class="btn btn-success"> Update</button>

</div>

                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
