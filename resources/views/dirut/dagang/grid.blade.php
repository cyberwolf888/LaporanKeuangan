@extends('layouts.dirut.layout1')

@section('title')
    Dagang
@endsection

@push('plugin_css')
    {!! Helper::registerDatatablesCss() !!}
@endpush

@section('page_title')
    {!! Helper::pageTitle('Dagang','Manage data pasar') !!}

@endsection

@section('breadcrumb')
    <li>
        <span class="active">Dagang</span>
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
                        <span class="caption-subject bold uppercase">Data Dagang</span>
                    </div>
                    <div class="actions">
                        <a href="{{ url('/dirut/dagang/create') }}" class="btn btn-circle green-sharp ">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Add New Data </span>
                        </a>
                        <div class="btn-group">
                            <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-share"></i>
                                <span class="hidden-xs"> Tools </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right" id="datatables_dagang_tools">
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
                        <table class="table table-striped table-bordered table-hover" id="datatables_dagang">
                            <thead>
                            <tr>
                                <th> No Dagang </th>
                                <th> Dagang </th>
                                <th> Pasar </th>
                                <th> Komoditas </th>
                                <th> Jenis </th>
                                <th> Status </th>
                                <th> Created At </th>
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
{!! Helper::registerDatatablesScript('datatables_dagang', url('/dirut/dagang/datatable'), [
    ['data'=>'id','name'=>'dagang.id'],
    ['data'=>'nama_dagang','name'=>'dagang.nama_dagang'],
    ['data'=>'nama_pasar','name'=>'pasar.nama_pasar'],
    ['data'=>'nama_komoditas','name'=>'komoditas.nama_komoditas'],
    ['data'=>'jenis_dagang','name'=>'dagang.jenis_dagang'],
    ['data'=>'status','name'=>'dagang.status'],
    ['data'=>'created_at','name'=>'dagang.created_at'],
    ['data'=>'action','name'=>'action', 'orderable'=>false, 'searchable'=> false]
]) !!}

{!! Helper::delScript(url('/dirut/dagang/delete')) !!}

<script>
    var approved = function(id){
        if (confirm("Are you sure want to approve this data?")) {
            var url = "{{ url('/dirut/dagang/approved') }}/"+id;
            $.ajaxSetup(
                    {
                        headers:
                        {
                            "X-CSRF-Token": $("meta[name='csrf-token']").attr("content")
                        }
                    });
            $.ajax({
                method: "POST",
                url: url,
                data: { id: id }
            }).success(function( data ) {
                $('#datatables_dagang').dataTable()._fnAjaxUpdate();
            });

        } else {
            return false;
        }
    };

    var pending = function(id){
        if (confirm("Are you sure want to pending this data?")) {
            var url = "{{ url('/dirut/dagang/pending') }}/"+id;
            $.ajaxSetup(
                    {
                        headers:
                        {
                            "X-CSRF-Token": $("meta[name='csrf-token']").attr("content")
                        }
                    });
            $.ajax({
                method: "POST",
                url: url,
                data: { id: id }
            }).success(function( data ) {
                $('#datatables_dagang').dataTable()._fnAjaxUpdate();
            });

        } else {
            return false;
        }
    };
</script>
@endpush