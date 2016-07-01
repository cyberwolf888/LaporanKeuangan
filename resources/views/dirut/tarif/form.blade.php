@if($errors->any())
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span> Please fix this folowing error: </span>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('success_message'))
    <div class="alert alert-success">
        <button class="close" data-close="alert"></button>
        <span> {{ Session::get('success_message') }} </span>
    </div>
@endif
<form role="form" id="form_tarif" action="" method="post">
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
                    {{ Form::text('label', $model->label, ['class' => 'form-control','id' => 'label']) }}
                    {!! Form::Label('label', 'Label Tarif') !!}
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
                    {{ Form::text('tarif', $model->tarif, ['class' => 'form-control','id' => 'tarif']) }}
                    {!! Form::Label('tarif', 'Tarif') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input form-md-floating-label">
                    {!! Form::select('type', [\App\Models\Pungutan::D_HARIAN=>'Harian', \App\Models\Pungutan::D_BULANAN=>'Bulanan'], $model->type, ['class' => 'form-control', 'id'=>'type']) !!}
                    {!! Form::Label('type', 'Tipe Tarif') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="form-actions noborder">
                <button type="submit" class="btn blue">Submit</button>
                <a href="{{ url('/dirut/tarif') }}" class="btn default">Cancel</a>
            </div>
        </div>
    </div>
</form>

@push('plugin_script')
{!! Helper::registerValidateJs() !!}
@endpush

@push('page_script')
<script>
    var FormValidationMd=function()
    {
        i=function()
        {
            var e=$("#form_tarif"),
                    r=$(".alert-danger",e),
                    i=$(".alert-success",e);
            e.validate({
                errorElement:"span",
                errorClass:"help-block",
                focusInvalid:!1,
                ignore:"",
                messages:
                {
                    nama_pasar:
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
                    label:{required:!0},
                    tarif:{required:!0}
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