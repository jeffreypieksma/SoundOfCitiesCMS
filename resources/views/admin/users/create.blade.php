@extends('layouts.app')

@section('content')
<div class="content">
            
    <div class="panel panel-default">
        <div class="panel-heading">Adding a user</div>
        {{-- Your Profile {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
--}}
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
           <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name">Name*</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" id="name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="name">E-mail*</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" id="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="role">Role*</label>
                    <select name="role" id="role" class="form-control">
                         <option value="1">User</option>
                         <option value="2">Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Password*</label> 
                    <input type="password" class="form-control" name="password" placeholder="Password" id="password" value="">
                </div>

                <div class="form-group">
                    <label for="password_confirm">Password*</label> 
                    <input type="password" class="form-control" name="password_confirm" placeholder="password_confirm" id="password_confirm" value="">
                </div>

                <div style="text-align:left;">
                    <input type="submit" value="Opslaan" class="save btn button btn-primary"/>
                </div>
           </form>
        </div>
    </div>
</div>
@endsection

