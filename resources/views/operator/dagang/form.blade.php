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
                    {!! Form::select('id_pasar', $pasar, $model->id_pasar, ['class' => 'form-control', 'id'=>'id_pasar']) !!}
                    {!! Form::Label('id_pasar', 'Pasar') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {!! Form::select('id_komoditas', $komoditas, $model->id_komoditas, ['class' => 'form-control', 'id'=>'id_komoditas']) !!}
                    {!! Form::Label('id_komoditas', 'Komoditas') !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {{ Form::text('nama_dagang', $model->nama_dagang, ['class' => 'form-control','id' => 'nama_dagang']) }}
                    {!! Form::Label('nama_dagang', 'Nama Dagang') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {!! Form::select('jenis_dagang', [\App\Models\Dagang::JN_KS=>'Kios', \App\Models\Dagang::JN_PN=>'Pelataran'], $model->jenis_dagang, ['class' => 'form-control', 'id'=>'jenis_dagang']) !!}
                    {!! Form::Label('jenis_dagang', 'Jenis Dagang') !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {{ Form::text('lokasi', $model->lokasi, ['class' => 'form-control','id' => 'lokasi']) }}
                    {!! Form::Label('lokasi', 'Lokasi') !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">

            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-actions noborder">
                    <button type="submit" class="btn blue">Submit</button>
                    <a href="{{ url('/operator/dagang') }}" class="btn default">Cancel</a>
                </div>
            </div>
        </div>

    </div>

</form>
</div>

@push('plugin_script')
{!! Helper::registerJs('/global/plugins/select2/js/select2.full.min.js') !!}
{!! Helper::registerValidateJs() !!}
@endpush

@push('page_script')
<script type="text/javascript">
    $(document).ready(function() {
        $("#id_pasar").select2();
        $("#id_komoditas").select2();
    });
</script>
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
                messages:
                {
                    nama_dagang:
                    {
                        minlength: jQuery.validator.format("Please, at least {0} characters are necessary")
                    },
                    payment:
                    {
                        maxlength:jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength:jQuery.validator.format("At least {0} items must be selected")
                    },
                    "checkboxes1[]":
                    {
                        required:"Please check some options",
                        minlength:jQuery.validator.format("At least {0} items must be selected")
                    },
                    "checkboxes2[]":
                    {
                        required:"Please check some options",
                        minlength:jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules:
                {
                    nama_dagang:{minlength:5,required:!0},
                    lokasi:{minlength:3,required:!0},
                    /*
                     email:{required:!0,email:!0},
                     email2:{required:!0,email:!0},
                     url:{required:!0,url:!0},
                     url2:{required:!0,url:!0},
                     number:{required:!0,number:!0},
                     number2:{required:!0,number:!0},
                     digits:{required:!0,digits:!0},
                     creditcard:{required:!0,creditcard:!0},
                     delivery:{required:!0},
                     payment:{required:!0,minlength:2,maxlength:4},
                     memo:{required:!0,minlength:10,maxlength:40}
                     */
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