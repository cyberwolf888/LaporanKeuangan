@if($errors->any())
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
@endif
@if(Session::has('success_message'))
    <div class="col-md-12">
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span> {{ Session::get('success_message') }} </span>
        </div>
    </div>
@endif

<form role="form" id="form_dagang" action="" method="post">
    <div class="col-md-12">
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            You have some form errors. Please check below.
        </div>
    </div>
    {!! csrf_field() !!}
    <div class="form-body">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {{ Form::text('nama_lengkap', $model->pegawai->nama_lengkap, ['class' => 'form-control','id' => 'nama_lengkap']) }}
                    {!! Form::Label('nama_lengkap', 'Nama Lengkap') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {{ Form::text('email', $model->email, ['class' => 'form-control','id' => 'email']) }}
                    {!! Form::Label('email', 'Email') !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {{ Form::text('no_telp', $model->pegawai->no_telp, ['class' => 'form-control','id' => 'no_telp']) }}
                    {!! Form::Label('no_telp', 'No Telp') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {!! Form::select('jenis_kelamin', [\App\Models\Pegawai::LAKI_LAKI=>'Laki-laki', \App\Models\Pegawai::PEREMPUAN=>'Perempuan'], $model->pegawai->jenis_kelamin, ['class' => 'form-control', 'id'=>'jenis_kelamin']) !!}
                    {!! Form::Label('jenis_kelamin', 'Jenis Kelamin') !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {{ Form::text('alamat', $model->pegawai->alamat, ['class' => 'form-control','id' => 'alamat']) }}
                    {!! Form::Label('alamat', 'Alamat') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {!! Form::select('status', [\App\User::S_ACTIVE=>'Active', \App\User::S_PENDING=>'Pending'], $model->status, ['class' => 'form-control', 'id'=>'status']) !!}
                    {!! Form::Label('status', 'Status') !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-actions noborder">
                    <button type="submit" class="btn blue">Submit</button>
                    <a href="{{ url('/dirut/pegawai/dirut') }}" class="btn default">Cancel</a>
                </div>
            </div>
        </div>

    </div>

</form>
</div>

@push('plugin_script')
{!! Helper::registerValidateJs() !!}
@endpush

@push('page_script')
<script>
    var FormValidationMd=function()
    {
        i=function()
        {
            var e=$("#form_dagang"),
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
                    email:{required:!0},
                    no_telp:{required:!0},
                    jenis_kelamin:{required:!0},
                    alamat:{required:!0},
                    status:{required:!0}
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
    jQuery(document).ready(function(){FormValidationMd.init()});
</script>
@endpush