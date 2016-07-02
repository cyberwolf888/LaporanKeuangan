@extends('layouts.dirut.layout1')

@section('title')
    Petugas
@endsection

@push('plugin_css')

@endpush

@section('page_title')
    {!! Helper::pageTitle('Pegawai','Create Petugas') !!}
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ url('/dirut/pegawai/petugas') }}">Petugas</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Create</span>
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
                        <span class="caption-subject bold uppercase">Create New Data</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        @include('dirut.pegawai.petugas.form')
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>

@endsection

