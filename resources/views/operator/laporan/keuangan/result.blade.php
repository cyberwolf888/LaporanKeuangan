@extends('layouts.operator.layout1')

@section('title')
    Laporan Keuangan
@endsection

@push('plugin_css')
{!! Helper::registerDatatablesCss() !!}
@endpush

@section('page_title')
    {!! Helper::pageTitle('Laporan','Keuangan') !!}

@endsection

@section('breadcrumb')
    <li>
        <span class="active">Laporan</span>
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
                <h4 class="widget-thumb-heading">Total Pungutan</h4>
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
                        <span class="caption-subject bold uppercase">Laporan Periode {!! date('d/m/Y', strtotime($start_date)) !!} Sampai  {!! date('d/m/Y', strtotime($end_date)) !!}</span>
                    </div>
                    <div class="actions">
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
                                <th> Tanggal <br> Pungutan</th>
                                <th> Tanggal <br> Disetor</th>
                                <th> Pasar </th>
                                <th> Dagang </th>
                                <th> Tipe <br> Setoran</th>
                                <th> Jenis <br> Setoran </th>
                                <th> Sewa Tempat </th>
                                <th> Air </th>
                                <th> Listrik </th>
                                <th> PPN 10%</th>
                                <th> Total </th>
                                <th> Created At </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                            @foreach($detail as $data)
                                <tr>
                                    <td> {{ $i }} </td>
                                    <td> {{ date('d/m/Y', strtotime($data->tgl_pungutan)) }} </td>
                                    <td> {{ $data->deposited != null ? date('d/m/Y',strtotime($data->deposited)) : '-' }} </td>
                                    <td> {{ $data->nama_pasar }}<br><span> [{{ $data->id_pasar }}]</span> </td>
                                    <td> {{ $data->nama_dagang }}<br><span> [{{ $data->id_dagang }}]</span> </td>
                                    <td> {{ \App\Models\Pungutan::getLabelType($data->type) }} </td>
                                    <td> {{ \App\Models\Pungutan::getLabelDetail($data->detail) }} </td>
                                    <td> {{ Helper::formatMoney($data->tempat_berjualan == null ? $data->sewa_tempat : $data->tempat_berjualan) }} </td>
                                    <td> {{ $data->listrik == null ? '-' : Helper::formatMoney($data->listrik) }} </td>
                                    <td> {{ $data->air == null ? '-' : Helper::formatMoney($data->air) }} </td>
                                    <td> {{ Helper::formatMoney($data->ppn_harian == null ? $data->ppn_bulanan : $data->ppn_harian) }} </td>
                                    <td> {{ Helper::formatMoney($data->total_harian == null ? $data->total_bulanan : $data->total_harian) }} </td>
                                    <td> {{ date('d/m/Y', strtotime($data->created_at)) }}<br><span>{{ date('H:i:s', strtotime($data->created_at)) }}</span> </td>
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
@endsection

@push('plugin_script')
{!! Helper::registerDatatablesJs() !!}
@endpush

@push('page_script')
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
                            {extend:"print",className:"btn dark btn-outline", orientation: 'landscape', pageSize: 'LEGAL'},
                            {extend:"copy",className:"btn red btn-outline"},
                            {extend:"pdf",className:"btn green btn-outline", orientation: 'landscape', pageSize: 'LEGAL'},
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