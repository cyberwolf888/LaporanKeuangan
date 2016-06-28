@if(Session::has('error_message'))
    <div class="col-md-12">
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span> {{ Session::get('error_message') }} </span>
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
<div class="col-md-12">
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        You have some form errors. Please check below.
    </div>
</div>
<div class="form-body">
    <div class="col-md-12">
        <div class="col-md-4">
            {!! Form::text('id_pasar', \App\Models\Pasar::find(Auth::user()->pegawai->id_pasar)->nama_pasar, ['class' => 'form-control form-control-inline', 'style'=>'margin-top:10px;', 'id'=>'id_pasar', 'readonly']) !!}
        </div>
        <div class="col-md-4">
            <div class="input-group  date date-picker" data-provide="datepicker" data-date-end-date="0d" style="margin-top:10px;">
                {!! Form::text('tgl_pungutan', null, ['class' => 'form-control', 'id'=>'tgl_pungutan', 'style'=>'background-color:white;', 'readonly']) !!}
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="form-actions noborder">
                <button type="button" class="btn blue" id="btn_search"><i class="fa fa-search"></i>Search</button>
                <a href="{{ url('/petugas/pungutan/harian') }}" class="btn default">Cancel</a>
            </div>
        </div>
    </div>
</div>
@push('plugin_script')
{!! Helper::registerJs('/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
@endpush

@push('page_script')
<script type="text/javascript">
    $('.date.date-picker').datepicker({
        format: "dd-mm-yyyy",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $('#btn_search').click(function () {
        var tgl_pungutan = $('#tgl_pungutan').val();
        if(tgl_pungutan == ''){
            $('.alert.alert-danger').show();
            $('.date.date-picker').addClass("has-error");
        }else{
            window.location = "{{url('/petugas/tunggakan/harian/create')}}/"+tgl_pungutan;
        }
    })
</script>
@endpush
