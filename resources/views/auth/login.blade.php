@extends('layouts.app')

@section('content')
<section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                           
                                <input id="email" type="email"  name="email" value="{{ old('email') }}" placeholder = "Email Address" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                            
                                <input id="password" type="password" class="form-control" name="password" placeholder = "Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div >
                           
                                        
                                   <span>
                       <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </span>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form  role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" placeholder = "Full name" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                            
                                <input id="email" type="email" placeholder = "Email address" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>
                         <div class="{{ $errors->has('phone') ? ' has-error' : '' }}">
                            
                                <input id="text" type="text" placeholder = "Phone " name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                           
                              <input id="password" type="password" placeholder = "Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div >
                           
                                <input id="password-confirm" type="password" placeholder = "Re-enter Password" name="password_confirmation" required>
                        
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

@endsection
