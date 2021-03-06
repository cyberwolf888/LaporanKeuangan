@extends('layouts.operator.layout1')

@section('title')
    Setoran
@endsection

@push('plugin_css')
{!! Helper::registerDatatablesCss() !!}
@endpush

@section('page_title')
    {!! Helper::pageTitle('Setoran','Manage data setoran') !!}

@endsection

@section('breadcrumb')
    <li>
        <span class="active">Setoran</span>
    </li>
@endsection

@section('content')
    <div class="row">
        @if($total->total_harian != null)
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Pungutan Harian</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-green icon-layers"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">IDR</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$total->total_harian}}">{{ number_format($total->total_harian,0,',','.') }}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        @endif

        @if($total->total_bulanan != null)
        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Pungutan Bulanan</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-blue icon-layers"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">IDR</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$total->total_bulanan}}">{{ number_format($total->total_bulanan,0,',','.') }}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
        @endif

        <div class="col-md-4">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">Total Setor</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-red icon-layers"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">IDR</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{!! $total->total_harian+$total->total_bulanan !!}">{!! number_format($total->total_harian+$total->total_bulanan,0,',','.') !!}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-share font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase">Rincian Setoran Petugas {{$petugas->nama_lengkap}} Tanggal {{$tgl}}</span>
                    </div>
                    <div class="actions">
                        <button class="btn green-sharp btn-circle" data-toggle="confirmation" data-popout="true" data-original-title="Apakah anda yakin melakukan setoran pada pungutan ini?" id="btn-setor">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Setor Semua </span>
                        </button>
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
                                </li>
                            </ul>
                        </div>
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover table-header-fixed" id="datatables_pasar">
                            <thead>
                            <tr class="">
                                <th> No </th>
                                <th> Pasar </th>
                                <th> Dagang </th>
                                <th> Tipe </th>
                                <th> Jenis </th>
                                <th> Total </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($pungutan as $data)
                                <tr>
                                    <td> {{ $i }} </td>
                                    <td> {{ $pasar->nama_pasar }} </td>
                                    <td> {{ $data->nama_dagang }} </td>
                                    <td> {{ $data->getLabelType($data->type) }} </td>
                                    <td> {{ $data->getLabelDetail($data->detail) }} </td>
                                    <td> {{ Helper::formatMoney($data->total_harian == null ? $data->total_bulanan : $data->total_harian) }} </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>
<form method="post" id="frm_setor">
    {!! csrf_field() !!}
</form>
@endsection

@push('plugin_script')
{!! Helper::registerJs('/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') !!}
{!! Helper::registerDatatablesJs() !!}
@endpush

@push('page_script')
<script type="text/javascript">
    $("#btn-setor").on("confirmed.bs.confirmation",function(){$('#frm_setor').submit();});
    $("#btn-setor").on("canceled.bs.confirmation",function(){return false;})
</script>
<script type="text/javascript">
    var TableDatatablesButtons = function(){
        a=function(){
            var e=$("#datatables_pasar"),
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
                            {extend:"print",className:"btn dark btn-outline"},
                            {extend:"copy",className:"btn red btn-outline"},
                            {extend:"pdf",className:"btn green btn-outline"},
                            {extend:"excel",className:"btn yellow btn-outline "},
                            {extend:"csv",className:"btn purple btn-outline "},
                            {extend:"colvis",className:"btn dark btn-outline",text:"Columns"}
                        ],
                        //responsive:!0,
                        order:[[0,"asc"]],
                        //lengthMenu:[[5,10,15,20,-1],[5,10,15,20,"All"]],
                        pageLength:10
                    });
            $("#datatables_pasar_tools > li > a.tool-action").on("click",function(){
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