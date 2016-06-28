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

<form role="form" id="form_data" action="" method="post">
    <div class="col-md-12">
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            You have some form errors. Please check below.
        </div>
    </div>
    {!! csrf_field() !!}
    {!! Form::hidden('tgl_pungutan', Carbon\Carbon::createFromFormat('m-Y', $date)->format('Y-m-d'),[ 'id'=>'tgl_pungutan']) !!}
    <div class="form-body">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    {!! Form::text('id_pasar', \App\Models\Pasar::find(Auth::user()->pegawai->id_pasar)->nama_pasar,['class' => 'form-control', 'id'=>'id_pasar', 'disabled']) !!}
                    {!! Form::Label('id_pasar', 'Pasar') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    {!! Form::select('id_dagang', $dagang,[], ['class' => 'form-control', 'id'=>'id_dagang']) !!}
                    {!! Form::Label('id_dagang', 'Dagang') !!}
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    {!! Form::number('sewa_tempat', $tarif->find(4)->tarif, ['class' => 'form-control', 'id'=>'sewa_tempat', 'min'=>0]) !!}
                    {!! Form::Label('sewa_tempat', 'Sewa Tempat') !!}
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    {!! Form::number('ppn', null, ['class' => 'form-control', 'id'=>'ppn', 'min'=>0, 'disabled']) !!}
                    {!! Form::Label('ppn', 'PPN 10%') !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    {!! Form::number('total', null, ['class' => 'form-control', 'id'=>'total', 'min'=>0, 'disabled']) !!}
                    {!! Form::Label('total', 'Total') !!}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-actions noborder">
                    <button type="submit" class="btn blue">Submit</button>
                    <a href="{{ url('/petugas/pungutan/bulanan') }}" class="btn default">Cancel</a>
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
        $("#id_dagang").select2();

        var sewa_tempat = $("#sewa_tempat").val();

        function setTotal() {
            var ppn = null;
            var total = null;

            ppn = Number(sewa_tempat)*Number(10)/Number(100);
            total = Number(sewa_tempat)+Number(ppn);

            $("#ppn").val(ppn);
            $("#total").val(total);
        };
        $("#sewa_tempat").change(function () {
            sewa_tempat = $(this).val();
            setTotal();
        });
        setTotal();
    });
</script>
<script>
    var FormValidationMd=function()
    {
        i=function()
        {
            var e=$("#form_data"),
                    r=$(".alert-danger",e),
                    i=$(".alert-success",e);
            e.validate({
                errorElement:"span",
                errorClass:"help-block",
                focusInvalid:!1,
                ignore:"",
                rules:
                {
                    sewa_tempat:{required:!0}
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