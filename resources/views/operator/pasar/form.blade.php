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
<form role="form" id="form_pasar" action="" method="post">
    {!! csrf_field() !!}
    <div class="form-body">
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            You have some form errors. Please check below.
        </div>
        <div class="form-group form-md-line-input form-md-floating-label">
            <input type="text" class="form-control" id="form_control_1" name="nama_pasar" value="{{ $model->nama_pasar }}">
            <label for="form_control_1">Nama Pasar</label>
        </div>
    </div>
    <div class="form-actions noborder">
        <button type="submit" class="btn blue">Submit</button>
        <a href="{{ url('/operator/pasar') }}" class="btn default">Cancel</a>
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
            var e=$("#form_pasar"),
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
                    nama_pasar:{minlength:5,required:!0},
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