@extends('layouts.dirut.layout1')

@section('title')
    Operator
@endsection

@push('plugin_css')
{!! Helper::registerDatatablesCss() !!}
@endpush

@section('page_title')
    {!! Helper::pageTitle('Operator','Manage data operator') !!}

@endsection

@section('breadcrumb')
    <li>
        <span class="active">Operator</span>
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
                        <span class="caption-subject bold uppercase">Data Operator</span>
                    </div>
                    <div class="actions">
                        <a href="{{ url('/dirut/pegawai/operator/create') }}" class="btn btn-circle green-sharp ">
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
                                <th> ID Pegawai </th>
                                <th> Email </th>
                                <th> Nama Lengkap </th>
                                <th> Jenis Kelamin </th>
                                <th> No Telp </th>
                                <th> Alamat </th>
                                <th> Status </th>
                                <th> </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model as $data)
                                <tr>
                                    <td> {{ $data->pegawai->getKey() }} </td>
                                    <td> {{ $data->email }} </td>
                                    <td> {{ $data->pegawai->nama_lengkap }} </td>
                                    <td> {{ $data->pegawai->getLabelJenisKelamin($data->pegawai->jenis_kelamin) }} </td>
                                    <td> {{ $data->pegawai->no_telp }} </td>
                                    <td> {{ $data->pegawai->alamat }} </td>
                                    <td> {{ $data->getLabelStatus($data->status) }} </td>
                                    <td> <a href="{{ url('/dirut/pegawai/operator/edit').'/'.$data->id }}" class="btn btn-icon-only blue" title="Edit"><i class="fa fa-pencil"></i></a> </td>
                                </tr>
                            @endforeach
                            </tbody>
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
<script type="text/javascript">
    var TableDatatablesButtons = function(){
        a=function(){
            var e=$("#datatables_dagang"),
                    t=e.dataTable({
                        //processing: true,
                        //serverSide: true,
                        //ajax: "http://localhost/laporankeuangan/operator/pasar/datatable",
                        //columns: [{"data":"id","name":"pasar.id"},{"data":"nama_pasar","name":"pasar.nama_pasar"},{"data":"nama_lengkap","name":"pegawai.nama_lengkap"},{"data":"created_at","name":"pasar.created_at"},{"data":"updated_at","name":"pasar.updated_at"},{"data":"action","name":"action","orderable":false,"searchable":false}],
                        language:{
                            aria:{
                                sortAscending:": activate to sort column ascending",
                                sortDescending:": activate to sort column descending"
                            },
                            emptyTable:"No data available in table",
                            info:"Showing _START_ to _END_ of _TOTAL_ entries",
                            infoEmpty:"No entries found",
                            infoFiltered:"(filtered1 from _MAX_ total entries)",
                            lengthMenu:"_MENU_ entries",
                            search:"Search:",
                            zeroRecords:"No matching records found"
                        },
                        buttons:[
                            {extend:"print",className:"btn dark btn-outline", orientation: 'potrait', pageSize: 'LEGAL'},
                            {extend:"copy",className:"btn red btn-outline"},
                            {extend:"pdf",className:"btn green btn-outline", orientation: 'potrait', pageSize: 'LEGAL'},
                            {extend:"excel",className:"btn yellow btn-outline "},
                            {extend:"csv",className:"btn purple btn-outline "},
                            {extend:"colvis",className:"btn dark btn-outline",text:"Columns"}
                        ],
                        //responsive:!0,
                        order:[[0,"asc"]],
                        //lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
                        pageLength:10
                    });
            $("#datatables_dagang_tools > li > a.tool-action").on("click",function(){
                var e=$(this).attr("data-action");
                t.DataTable().button(e).trigger()
            })
        };
        return{
            init:function(){
                jQuery().dataTable&&(a())
            }
        }
    }();
    jQuery(document).ready(function(){TableDatatablesButtons.init()});
</script>

@endpush