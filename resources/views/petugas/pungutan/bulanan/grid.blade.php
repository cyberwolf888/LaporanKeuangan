@extends('layouts.petugas.layout1')

@section('title')
    Pungutan
@endsection

@push('plugin_css')
{!! Helper::registerDatatablesCss() !!}
@endpush

@section('page_title')
    {!! Helper::pageTitle('Pungutan','Manage data pungutan bulanan') !!}

@endsection

@section('breadcrumb')
    <li>
        <a href="javascript:null">Pungutan</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Bulanan</span>
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
                        <span class="caption-subject bold uppercase">Data Pungutan Bulanan</span>
                    </div>
                    <div class="actions">
                        <a href="{{ url('/petugas/pungutan/bulanan/create') }}" class="btn btn-circle green-sharp ">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Pungutan </span>
                        </a>
                        <a href="{{ url('/petugas/tunggakan/bulanan/create') }}" class="btn btn-circle yellow-casablanca ">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Tunggakan </span>
                        </a>
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> Tools </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" id="datatables_pungutan_tools">
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
                        <table class="table table-striped table-bordered table-hover" id="datatables_pungutan">
                            <thead>
                            <tr>
                                <th> Tgl Pungutan </th>
                                <th> Pasar </th>
                                <th> Dagang </th>
                                <th> Type </th>
                                <th> Total </th>
                                <th> Disetor </th>
                                <th> </th>
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
{!! Helper::registerDatatablesScript('datatables_pungutan', url('/petugas/pungutan/bulanan/datatable'), [
    ['data'=>'tgl_pungutan','name'=>'pungutan.tgl_pungutan'],
    ['data'=>'nama_pasar','name'=>'ps.nama_pasar'],
    ['data'=>'nama_dagang','name'=>'dg.nama_dagang'],
    ['data'=>'type','name'=>'pungutan.type'],
    ['data'=>'total','name'=>'h.total'],
    ['data'=>'deposited','name'=>'pungutan.deposited'],
    ['data'=>'action','name'=>'action', 'orderable'=>false, 'searchable'=> false]
], null, [['0'=>'desc']]) !!}
@endpush