@extends('layouts.login')

@section('content')
        <!-- BEGIN : LOGIN PAGE 5-1 -->
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset">
            <div class="login-bg" style="background-image:url({{ url('/assets') }}/pages/img/login/bg2-min.jpg)">
                <img class="login-logo" src="{{ url('/assets') }}/pages/img/login/logo2.png" /> </div>
        </div>
        <div class="col-md-6 login-container bs-reset">
            <div class="login-content">
                <h1>User Login</h1>
                <p> Please authentication your email address and password before using this system. Contact operator to register new user.</p>
                <form action="{{ url('/login') }}" class="login-form" method="post">
                    {!! csrf_field() !!}
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Enter any username and password. </span>
                    </div>
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span>{{ $errors->first('email') }} </span>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span>{{ $errors->first('password') }} </span>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required/> </div>
                        <div class="col-xs-6">
                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="rem-password">
                                <p>Remember Me
                                    <input type="checkbox" class="rem-checkbox" name="remember"/>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-8 text-right">
                            <div class="forgot-password">
                                <a href="{{ url('/password/reset') }}" id="forget-password" class="forget-password">Forgot Password?</a>
                            </div>
                            <button class="btn blue" type="submit">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <div class="row bs-reset">

                    <div class="col-md-5 bs-reset">
                        <!--
                        <ul class="login-social">
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="icon-social-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                        -->
                    </div>

                    <div class="col-md-7 col-xs-9 bs-reset">
                        <div class="login-copyright text-right">
                            <p>Copyright &copy; Rah Manik {{ date('Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END : LOGIN PAGE 5-1 -->
@endsection

@push('scripts')
    <script type="text/javascript">
        var Login=function(){var r=function(){$(".login-form").validate({errorElement:"span",errorClass:"help-block",focusInvalid:!1,rules:{username:{required:!0},password:{required:!0},remember:{required:!1}},messages:{username:{required:"Username is required."},password:{required:"Password is required."}},invalidHandler:function(r,e){$(".alert-danger",$(".login-form")).show()},highlight:function(r){$(r).closest(".form-group").addClass("has-error")},success:function(r){r.closest(".form-group").removeClass("has-error"),r.remove()},errorPlacement:function(r,e){r.insertAfter(e.closest(".input-icon"))},submitHandler:function(r){r.submit()}}),$(".login-form input").keypress(function(r){return 13==r.which?($(".login-form").validate().form()&&$(".login-form").submit(),!1):void 0}),$(".forget-form input").keypress(function(r){return 13==r.which?($(".forget-form").validate().form()&&$(".forget-form").submit(),!1):void 0}),$("#forget-password").click(function(){$(".login-form").hide(),$(".forget-form").show()}),$("#back-btn").click(function(){$(".login-form").show(),$(".forget-form").hide()})};return{init:function(){r(),$(".login-bg").backstretch(["{{ url('/assets') }}/pages/img/login/bg2-min.jpg"],{fade:1e3,duration:8e3}),$(".forget-form").hide()}}}();jQuery(document).ready(function(){Login.init()});
    </script>
@endpush