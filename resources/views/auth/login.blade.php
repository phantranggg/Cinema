@extends('layouts.app')

@section('content')
<div class="form">

    <ul class="tab-group">
        <li class="tab"><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
    </ul>

    <div class="tab-content">

        <div id="login">
            <h1 class="login-h1-text">Welcome Back!</h1>
            <form method="POST" action="{{ route('login') }}">
                <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                <div class="field-wrap {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">
                        Email Address<span class="req">*</span>
                    </label>
                    <input id="email" type="email" name="email" required>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="field-wrap {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">
                        Password<span class="req">*</span>
                    </label>
                    <input id="password" type="password" name="password" required>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <p class="forgot"><a href="{{ route('password.request') }}">Forgot Password?</a></p>

                <input type="submit" class="button button-block" value="Get Started"/>
            </form>
        </div>

        <div id="signup">
            <h1 class="login-h1-text">Sign Up for Free</h1>
            <form method="POST" action="{{ route('register') }}">
                <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                <div class="field-wrap {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">
                        Email Address<span class="req">*</span>
                    </label>
                    <input id="email_register" type="email" name="email" required>
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="top-row">

                    <div class="field-wrap {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">
                            Password<span class="req">*</span>
                        </label>
                        <input id="password_register" type="password" name="password" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="field-wrap">
                        <label for="password-confirm"">Confirm Password</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required>
                    </div>
                </div>
                <div class="top-row">
                    <div class="field-wrap {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">
                            Name<span class="req">*</span>
                        </label>
                        <input id="name" type="text" name="name">
                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="field-wrap {{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                        <label for="date_of_birth">
                            Date of Birth<span class="req">*</span>
                        </label>
                        <input id="date_of_birth" type="date" name="date_of_birth">
                        @if ($errors->has('date_of_birth'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="field-wrap {{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone">
                        Phone<span class="req">*</span>
                    </label>
                    <input id="phone" type="text" name="phone">
                    @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="field-wrap {{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address">
                        Address<span class="req">*</span>
                    </label>
                    <input id="address" type="text" name="address">
                    @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                    @endif
                </div>

                <input type="submit" class="button button-block" value="Get Started"/>
            </form>
        </div>

    </div><!-- tab-content -->

</div> <!-- /form -->

<script src=" {{ asset('js/login_register.js') }}"></script>
@endsection