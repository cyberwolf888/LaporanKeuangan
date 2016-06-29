@extends('layouts.operator.layout1')

@section('title')
    Setoran
@endsection

@push('plugin_css')
{!! Helper::registerCss('/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') !!}
{!! Helper::registerCss('/global/plugins/select2/css/select2.min.css') !!}
{!! Helper::registerCss('/global/plugins/select2/css/select2-bootstrap.min.css') !!}
@endpush

@section('page_title')
    <h1>Setoran
        <small>Create data setoran</small>
    </h1>
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ url('/operator/setoran') }}">Setoran</a>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('tgl_pungutan', 'Tgl Pungutan') !!}
                                        <div class="input-group  date date-picker" data-provide="datepicker" data-date-end-date="0d">
                                            {!! Form::text('tgl_pungutan', date('d-m-Y'), ['class' => 'form-control', 'id'=>'tgl_pungutan', 'style'=>'background-color:white;', 'readonly']) !!}
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fa fa-calendar"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('id_pasar', 'Pasar', ['class'=>'control-label']) !!}
                                        {!! Form::select('id_pasar',$pasar,[],['id'=>'id_pasar', 'class'=>'form-control select2']) !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('id_petugas', 'Petugas', ['class'=>'control-label']) !!}
                                        {!! Form::select('id_petugas',[],[],['id'=>'id_petugas', 'class'=>'form-control select2']) !!}
                                        </select>
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
    $('.date.date-picker').datepicker({
        format: "dd-mm-yyyy",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });
    $('#id_pasar').select2({
        theme: "bootstrap",
    }).on("change", function(e) {
        //console.log(e.target.value);
        $('#id_petugas').select2("val", "");
    });
    $('#id_petugas').select2({
        theme: "bootstrap",
        placeholder: "Select Petugas",
        allowClear: true,
        ajax: {
            url: "{!! url('/operator/setoran/getPetugas') !!}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    id_pasar: $('#id_pasar').val()
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: false
        },
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