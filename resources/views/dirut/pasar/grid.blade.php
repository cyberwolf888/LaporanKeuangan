@extends('layouts.dirut.layout1')

@section('title')
    Pasar
@endsection

@push('plugin_css')
    {!! Helper::registerDatatablesCss() !!}
@endpush

@section('page_title')
    {!! Helper::pageTitle('Pasar','Manage data pasar') !!}

@endsection

@section('breadcrumb')
    <li>
        <span class="active">Pasar</span>
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
                        <span class="caption-subject bold uppercase">Data Pasar</span>
                    </div>
                    <div class="actions">
                        <a href="{{ url('/dirut/pasar/create') }}" class="btn btn-circle green-sharp ">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Add New Data </span>
                        </a>
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> Tools </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" id="datatables_pasar_tools">
                                <li>
                                    <a href="javascript:;" data-action="0" class="tool-action">
                                        <i class="icon-printer"></i> Print</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="1" class="tool-action">
                                        <i class="icon-check"></i> Copy</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="2" class="tool-action">
                                        <i class="icon-doc"></i> PDF</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-action="3" class="tool-action">
                                        <i class="icon-paper-clip"></i> Excel</a>
                                </li>
                                <!-- <li>
                                    <a href="javascript:;" data-action="4" class="tool-action">
                                        <i class="icon-cloud-upload"></i> CSV</a>
                                </li> -->
                                <!-- <li class="divider"> </li>
                                <li>
                                    <a href="javascript:;" data-action="5" class="tool-action">
                                        <i class="icon-refresh"></i> Reload</a>
                                </li> -->
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover" id="datatables_pasar">
                            <thead>
                            <tr>
                                <th> ID Pasar </th>
                                <th> Nama Pasar </th>
                                <th> Created By </th>
                                <th> Created At </th>
                                <th> Updated At </th>
                                <th>  </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>

@endsection

@push('plugin_script')
    {!! Helper::registerDatatablesJs() !!}
@endpush

@push('page_script')
    {!! Helper::registerDatatablesScript('datatables_pasar', url('/dirut/pasar/datatable'), [
        ['data'=>'id','name'=>'pasar.id'],
        ['data'=>'nama_pasar','name'=>'pasar.nama_pasar'],
        ['data'=>'nama_lengkap','name'=>'pegawai.nama_lengkap'],
        ['data'=>'created_at','name'=>'pasar.created_at'],
        ['data'=>'updated_at','name'=>'pasar.updated_at'],
        ['data'=>'action','name'=>'action', 'orderable'=>false, 'searchable'=> false]
    ]) !!}

    {!! Helper::delScript(url('/dirut/pasar/delete')) !!}


@endpush