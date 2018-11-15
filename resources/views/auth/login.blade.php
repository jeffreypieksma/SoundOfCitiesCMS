@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m6 s12 offset-m3">       
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" required autofocus>
                            <label for="email">Email</label>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate" name="password" required>
                            <label for="password">Password</label>
                        </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col s12">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="filled-in col s12" checked="checked"> 
                            <span>Remember Me</span>
                        </label>          
                    </div>
                </div>

                <div class="form-group">        
                    <button type="submit" class="waves-effect waves-light btn">Login</button>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot Your Password?</a>       
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection