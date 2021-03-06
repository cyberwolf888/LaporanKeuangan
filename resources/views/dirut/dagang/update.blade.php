@extends('layouts.dirut.layout1')

@section('title')
    Dagang
@endsection

@push('plugin_css')
{!! Helper::registerCss('/global/plugins/select2/css/select2.min.css') !!}
{!! Helper::registerCss('/global/plugins/select2/css/select2-bootstrap.min.css') !!}
<style>
    .select2-container--bootstrap .select2-selection {  border: none;  }
</style>
@endpush

@section('page_title')
    <h1>Dagang
        <small>Update data dagang</small>
    </h1>
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ url('/dirut/dagang') }}">Dagang</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Update</span>
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
                        <span class="caption-subject bold uppercase">Update Data Dagang</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        @include('dirut.dagang.form')
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>

@endsection