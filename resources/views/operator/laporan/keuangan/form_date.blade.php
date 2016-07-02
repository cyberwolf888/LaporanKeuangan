@extends('layouts.operator.layout1')

@section('title')
    Laporan
@endsection

@push('plugin_css')
{!! Helper::registerCss('/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
{!! Helper::registerCss('/global/plugins/select2/css/select2.min.css') !!}
{!! Helper::registerCss('/global/plugins/select2/css/select2-bootstrap.min.css') !!}
@endpush

@section('page_title')
    <h1>Laporan
        <small>Mange laporan keuangan</small>
    </h1>
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ url('/operator/setoran') }}">Laporan Keuangan</a>
        <i class="fa fa-circle"></i>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-share font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase">Select Date</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <form role="form" id="form_data" action="" method="post">
                            {!! csrf_field() !!}
                            <div class="col-md-12">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button>
                                    You have some form errors. Please check below.
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::label('start_date', 'Start Date') !!}
                                            <div class="input-group start_date date date-picker" data-provide="datepicker" data-date-end-date="0d">
                                                {!! Form::text('start_date', date('d-m-Y'), ['class' => 'form-control', 'id'=>'start_date', 'style'=>'background-color:white;', 'readonly']) !!}
                                                <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::label('end_date', 'End Date') !!}
                                            <div class="input-group end_date date date-picker" data-provide="datepicker">
                                                {!! Form::text('end_date', date('d-m-Y'), ['class' => 'form-control', 'id'=>'end_date', 'style'=>'background-color:white;', 'readonly']) !!}
                                                <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::label('id_pasar', 'Pasar', ['class'=>'control-label']) !!}
                                            {!! Form::select('id_pasar',[0=>'Semua Pasar']+$pasar,[],['id'=>'id_pasar', 'class'=>'form-control select2']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {!! Form::label('sts_pungutan', 'Status Pungutan', ['class'=>'control-label']) !!}
                                            {!! Form::select('sts_pungutan',['Semua','Sudah disetor','Belum disetor'],[],['id'=>'sts_pungutan', 'class'=>'form-control select2']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-actions noborder">
                                            <button type="submit" class="btn blue" id="btn_search"><i class="fa fa-search"></i>Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
@endsection

@push('plugin_script')
{!! Helper::registerJs('/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
{!! Helper::registerJs('/global/plugins/select2/js/select2.full.min.js') !!}
{!! Helper::registerValidateJs() !!}
@endpush

@push('page_script')
<script type="text/javascript">
    $('.start_date.date.date-picker').datepicker({
        format: "dd-mm-yyyy",
        //startDate: '16-06-2016',
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        console.log(selected.date.valueOf());
        $('.end_date.date.date-picker').datepicker('setStartDate',minDate);
    });

    $('.end_date.date.date-picker').datepicker({
        format: "dd-mm-yyyy",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });

    $('#id_pasar').select2({
        theme: "bootstrap",
    }).on("change", function(e) {
        //console.log(e.target.value);
        //$('#id_petugas').select2("val", "");
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
                //errorElement:"span",
                errorClass:"help-block",
                focusInvalid:!1,
                ignore:"",
                rules:
                {
                    id_pasar:{required:!0},
                    id_petugas:{required:!0}
                },
                invalidHandler:function(e,t){
                    i.hide(),
                            r.show(),
                            App.scrollTo(r,-200)
                },
                errorPlacement: function(error, element) {
                    return false;
                },
                highlight:function(e){
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight:function(e){
                    $(e).closest(".form-group").removeClass("has-error")
                },
                success:function(e){
                    e.closest(".form-group").removeClass("has-error")
                },
            })
        };
        return{init:function(){i()}}
    }();
    jQuery(document).ready(function(){FormValidationMd.init()});
</script>
@endpush