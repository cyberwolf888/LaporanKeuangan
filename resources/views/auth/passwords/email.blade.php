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
                    <h1>Reset Password</h1>
                    <p> Enter your e-mail address below to reset your password. </p>
                    <!-- BEGIN FORGOT PASSWORD FORM -->
                    <form class="login-form" action="{{ url('/password/email') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>Enter any email. </span>
                        </div>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span>{{ $errors->first('email') }} </span>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                <button class="close" data-close="alert"></button>
                                <span>{{ session('status') }}</span>
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="email" autocomplete="off" class="form-control placeholder-no-fix form-group" placeholder="Email" name="email" value="{{ old('email') }}" id="email">
                        </div>

                        <div class="form-actions">
                            <a href="{{ url('/login') }}" id="back-btn" class="btn grey btn-default">Back</a>
                            <button type="submit" class="btn blue btn-success uppercase pull-right">Submit</button>
                        </div>
                    </form>
                    <!-- END FORGOT PASSWORD FORM -->
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
    var Login=function(){var r=function(){$(".login-form").validate({errorElement:"span",errorClass:"help-block",focusInvalid:!1,rules:{email:{required:!0,remember:{required:!1}},messages:{username:{required:"Username is required."},password:{required:"Password is required."}},invalidHandler:function(r,e){$(".alert-danger",$(".login-form")).show()},highlight:function(r){$(r).closest(".form-group").addClass("has-error")},success:function(r){r.closest(".form-group").removeClass("has-error"),r.remove()},errorPlacement:function(r,e){r.insertAfter(e.closest(".input-icon"))},submitHandler:function(r){r.submit()}}),$(".login-form input").keypress(function(r){return 13==r.which?($(".login-form").validate().form()&&$(".login-form").submit(),!1):void 0}),$(".forget-form input").keypress(function(r){return 13==r.which?($(".forget-form").validate().form()&&$(".forget-form").submit(),!1):void 0}),$("#forget-password").click(function(){$(".login-form").hide(),$(".forget-form").show()}),$("#back-btn").click(function(){$(".login-form").show(),$(".forget-form").hide()})};return{init:function(){r(),$(".login-bg").backstretch(["{{ url('/assets') }}/pages/img/login/bg2-min.jpg"],{fade:1e3,duration:8e3}),$(".forget-form").hide()}}}();jQuery(document).ready(function(){Login.init()});
</script>
@endpush