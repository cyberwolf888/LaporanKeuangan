@extends('layouts.operator.layout1')

@section('title')
    Profile
@endsection

@push('plugin_css')
{!! Helper::registerCss('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
{!! Helper::registerCss('/pages/css/profile.min.css') !!}
@endpush

@section('page_title')
    {!! Helper::pageTitle('Profile','Profile Operator') !!}
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ url('/operator/profile') }}">Profile</a>
        <i class="fa fa-circle"></i>
    </li>
@endsection

@section('content')
    @if($errors->any())
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span> Please fix this folowing error: </span>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    @if(Session::has('success_message'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <span> {{ Session::get('success_message') }} </span>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet bordered">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{ $model->pegawai->photo!=null ? url('/assets/photo/').'/'.$model->pegawai->photo : url('/assets/global/img/default-user-avatar.png') }}" class="img-responsive" alt=""> </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{ $model->pegawai->nama_lengkap }} </div>
                        <div class="profile-usertitle-job"> Operator </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->

                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="javascript:;">
                                    <i class="icon-settings"></i> Account Settings </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form role="form" action="{{ url('/operator/profile/overview') }}" method="post" id="overview">
                                            <div>
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button>
                                                    You have some form errors. Please check below.
                                                </div>
                                            </div>
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                {!! Form::label('nama_lengkap','Nama Lengkap',['class'=>'control-label']) !!}
                                                {!! Form::text('nama_lengkap',$model->pegawai->nama_lengkap,['id'=>'nama_lengkap','class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('email','Email',['class'=>'control-label']) !!}
                                                {!! Form::email('email',$model->email,['id'=>'email','class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('no_telp','No Telp',['class'=>'control-label']) !!}
                                                {!! Form::number('no_telp',$model->pegawai->no_telp,['id'=>'no_telp','class'=>'form-control']) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::Label('jenis_kelamin', 'Jenis Kelamin') !!}
                                                {!! Form::select('jenis_kelamin', [\App\Models\Pegawai::LAKI_LAKI=>'Laki-laki', \App\Models\Pegawai::PEREMPUAN=>'Perempuan'], $model->pegawai->jenis_kelamin, ['class' => 'form-control', 'id'=>'jenis_kelamin']) !!}
                                             </div>
                                            <div class="form-group">
                                                {!! Form::Label('alamat', 'Alamat') !!}
                                                {{ Form::textarea('alamat', $model->pegawai->alamat, ['class' => 'form-control','id' => 'alamat', 'rows'=>3]) }}
                                            </div>
                                            <div class="margiv-top-10">
                                                <button type="submit" value="Submit" class="btn green"> Save Changes </button>
                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->
                                    <!-- CHANGE AVATAR TAB -->
                                    <div class="tab-pane" id="tab_1_2">
                                        <form role="form" action="{{ url('/operator/profile/avatar') }}" method="post" id="avatar" enctype="multipart/form-data">
                                            <div>
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button>
                                                    You have some form errors. Please check below.
                                                </div>
                                            </div>
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                        <img src="{{ isset($model->pegawai->photo) ? url('/assets/photo/').'/'.$model->pegawai->photo : url('/assets/global/img/default-user-avatar.png') }}" alt="" /> </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="photo" id="photo"> </span>
                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="margin-top-10">
                                                <button type="submit" value="Submit" class="btn green"> Change Avatar </button>
                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE AVATAR TAB -->
                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_3">
                                        <form role="form" action="{{ url('/operator/profile/password') }}" method="post" id="frm_password">
                                            <div>
                                                <div class="alert alert-danger display-hide">
                                                    <button class="close" data-close="alert"></button>
                                                    You have some form errors. Please check below.
                                                </div>
                                            </div>
                                            {!! csrf_field() !!}
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" class="form-control" name="password" id="password"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Re-type New Password</label>
                                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation "/>
                                            </div>
                                            <div class="margin-top-10">
                                                <button type="submit" value="Submit" class="btn green"> Change Password </button>
                                                <a href="javascript:;" class="btn default"> Cancel </a>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
@endsection

@push('plugin_script')
{!! Helper::registerJs('/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
{!! Helper::registerJs('/global/plugins/jquery.sparkline.min.js') !!}
{!! Helper::registerValidateJs() !!}
@endpush

@push('page_script')
{!! Helper::registerJs('/pages/scripts/profile.min.js') !!}
<script>
    var Overview=function()
    {
        i=function()
        {
            var e=$("#overview"),
                    r=$(".alert-danger",e),
                    i=$(".alert-success",e);
            e.validate({
                errorElement:"span",
                errorClass:"help-block",
                focusInvalid:!1,
                ignore:"",
                rules:
                {
                    nama_lengkap:{required:!0},
                    email:{required:!0, email:!0},
                    no_telp:{required:!0, number:!0},
                    jenis_kelamin:{required:!0},
                    alamat:{required:!0}
                },
                invalidHandler:function(e,t){
                    i.hide(),
                            r.show(),
                            App.scrollTo(r,-200)
                },
                errorPlacement:function(e,r)
                {
                    r.is(":checkbox")?e.insertAfter(r.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline")):r.is(":radio")?e.insertAfter(r.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline")):e.insertAfter(r)},highlight:function(e){$(e).closest(".form-group").addClass("has-error")},unhighlight:function(e){$(e).closest(".form-group").removeClass("has-error")},success:function(e){e.closest(".form-group").removeClass("has-error")
                },
                //submitHandler:function(e){i.show(),r.hide()}
            })
        };
        return{init:function(){i()}}
    }();

    var Avatar=function()
    {
        j=function()
        {
            var e=$("#avatar"),
                    r=$(".alert-danger",e),
                    i=$(".alert-success",e);
            e.validate({
                errorElement:"span",
                errorClass:"help-block",
                focusInvalid:!1,
                ignore:"",
                rules:
                {
                    photo:{required:!0}
                },
                invalidHandler:function(e,t){
                    i.hide(),
                            r.show(),
                            App.scrollTo(r,-200)
                },
                errorPlacement:function(e,r)
                {
                    r.is(":checkbox")?e.insertAfter(r.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline")):r.is(":radio")?e.insertAfter(r.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline")):e.insertAfter(r)},highlight:function(e){$(e).closest(".form-group").addClass("has-error")},unhighlight:function(e){$(e).closest(".form-group").removeClass("has-error")},success:function(e){e.closest(".form-group").removeClass("has-error")
                },
                //submitHandler:function(e){i.show(),r.hide()}
            })
        };
        return{init:function(){j()}}
    }();

    var Password=function()
    {
        k=function()
        {
            var e=$("#frm_password"),
                    r=$(".alert-danger",e),
                    i=$(".alert-success",e);
            e.validate({
                errorElement:"span",
                errorClass:"help-block",
                focusInvalid:!1,
                ignore:"",
                rules:
                {
                    password:{minlength:8,required:!0},
                    password_confirmation :{minlength:8,required:!0}
                },
                invalidHandler:function(e,t){
                    i.hide(),
                            r.show(),
                            App.scrollTo(r,-200)
                },
                errorPlacement:function(e,r)
                {
                    r.is(":checkbox")?e.insertAfter(r.closest(".md-checkbox-list, .md-checkbox-inline, .checkbox-list, .checkbox-inline")):r.is(":radio")?e.insertAfter(r.closest(".md-radio-list, .md-radio-inline, .radio-list,.radio-inline")):e.insertAfter(r)},highlight:function(e){$(e).closest(".form-group").addClass("has-error")},unhighlight:function(e){$(e).closest(".form-group").removeClass("has-error")},success:function(e){e.closest(".form-group").removeClass("has-error")
                },
                //submitHandler:function(e){i.show(),r.hide()}
            })
        };
        return{init:function(){k()}}
    }();

    jQuery(document).ready(function(){
        Overview.init();
        Avatar.init();
        Password.init();
    });
</script>
@endpush

