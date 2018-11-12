@extends('layouts.admin')

@section('content')
<div class="content">
  <div class="panel panel-default">
    <div class="panel-heading">Edit {{$user->name}}</div>

    <div class="panel-body">

      <a href="{{ route('admin_users') }}" class="btn btn-primary">Terug naar lijst</a>
      @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
      @endif
       
      @if (Session::has('message'))
          <div class="alert alert-success">{{ Session::get('message') }}</div>
      @endif
      @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
       <form method="POST" action="{{route('update_user')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name"
                  placeholder="Name" id="name"
                  value="{{$user->name}}">
            </div>

            <div class="form-group {{ $errors->has('email') ? ' has-errors' : '' }}">
              <label for="name">Email</label>
              <input type="text" class="form-control" name="email"
                     placeholder="Email" id="email"
                     value="{{$user->email}}">
            </div>

            <div class="form-group {{ $errors->has('role') ? ' has-errors' : '' }}">
              <label for="role">Role</label>
              <select name="role" id="role" class="form-control">
                   <option value="1" @if ($user->role === 1) selected @endif>User</option>
                   <option value="2" @if ($user->role === 2) selected @endif>Admin</option>
              </select>
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-errors' : '' }}">
              <label for="password">Password</label> 
              <input type="password" class="form-control" name="password"
                     placeholder="Password" id="password"
                     value="">
            </div>

            <div class="form-group {{ $errors->has('password_confirm') ? ' has-errors' : '' }}">
              <label for="password_confirm">Password confirm</label> 
              <input type="password" class="form-control" name="password_confirm" placeholder="password_confirm" id="password_confirm" value="">
            </div>
 
            <a href="{{ route('delete_user', ['id' => $user->id])}}" 
              class="delete btn button btn-primary danger"
                onclick="return confirm('Weet je het zeker? ') ">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Verwijder
            </a>

             <a href="{{ route('delete_user', ['id' => $user->id])}}" 
              class="delete btn button btn-primary danger"
                onclick="return confirm('Weet je het zeker? ') ">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Verwijder
            </a>
              
            
            <input type="submit" value="Opslaan" class="save btn button btn-primary"/>
            
       </form>
    </div>
  </div>
</div>
@endsection