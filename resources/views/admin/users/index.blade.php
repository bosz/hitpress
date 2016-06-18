@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-3"><h2>Users</h2></div>
    <div class="col-md-3 col-md-offset-6">
        <button class="btn btn-primary pull-right"><a style="color: white" href="{{route('admin.users.create')}}">Create Users</a></button>
    </div>

</div>



    @if(Session::has('deleted_user'))
        <p>{{session('deleted_user')}}</p>

    @endif

<div class="container">
    <table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Active</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    <tbody>
    @if($users)
    @foreach($users as $user)
       <tr>
           <td>{{$user->id}}</td>
           <td><a href="{{route('admin.users.edit',$user->id)}}"><img height="50" src="{{$user->photo?$user->photo->file:"no photo available"}}" alt=""></a></td>
           <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
           <td>{{$user->email}}</td>
           <td>{{$user->role?$user->role->name:'administrator'}}</td>
           <td>{{$user->is_active==1?'Active':'Not Active'}}</td>
           <td>{{$user->created_at?$user->created_at->diffForHumans():'N/A'}}</td>
           <td>{{$user->updated_at?$user->updated_at->diffForHumans():'N/A'}}</td>
       </tr>
    @endforeach
    @endif
    </tbody>
    </table>
</div>

@stop
