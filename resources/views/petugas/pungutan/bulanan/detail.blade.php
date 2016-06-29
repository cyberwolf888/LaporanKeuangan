@extends('layouts.petugas.layout1')

@section('title')
    Pungutan
@endsection

@push('plugin_css')
@endpush

@section('page_title')
    <h1>Pungutan
        <small>Detail pungutan Bulanan</small>
    </h1>
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ url('/petugas/pungutan/bulanan') }}">Pungutan Bulanan</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span class="active">Detail</span>
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
                        <span class="caption-subject bold uppercase">Detail Pungutan Bulanan</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('id_pasar', $model->pasar->nama_pasar,['class' => 'form-control', 'id'=>'id_pasar', 'disabled']) !!}
                                    {!! Form::Label('id_pasar', 'Pasar') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('id_dagang', "(".$model->id_dagang.") ".$model->dagang->nama_dagang,['class' => 'form-control', 'id'=>'id_dagang', 'disabled']) !!}
                                    {!! Form::Label('id_dagang', 'Dagang') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('tgl_pungutan', $model->tgl_pungutan,['class' => 'form-control', 'id'=>'tgl_pungutan', 'disabled']) !!}
                                    {!! Form::Label('tgl_pungutan', 'Tgl Pungutan') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('type', $model->getLabelType($model->type),['class' => 'form-control', 'id'=>'type', 'disabled']) !!}
                                    {!! Form::Label('type', 'Type') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('deposited', $model->deposited == '' ? '-' : $model->deposited,['class' => 'form-control', 'id'=>'deposited', 'disabled']) !!}
                                    {!! Form::Label('deposited', 'Setoran') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('deposited_to', $model->deposited_to == '' ? '-' : \App\User::find($model->deposited_to)->pegawai->nama_lengkap,['class' => 'form-control', 'id'=>'deposited_to', 'disabled']) !!}
                                    {!! Form::Label('deposited_to', 'Disetor Ke') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('tempat_berjualan', Helper::formatMoney($model->bulanan->sewa_tempat), ['class' => 'form-control', 'id'=>'tempat_berjualan', 'disabled']) !!}
                                    {!! Form::Label('tempat_berjualan', 'Tempat Berjualan') !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('ppn', Helper::formatMoney($model->bulanan->ppn), ['class' => 'form-control', 'id'=>'ppn', 'min'=>0, 'disabled']) !!}
                                    {!! Form::Label('ppn', 'PPN 10%') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    {!! Form::text('total', Helper::formatMoney($model->bulanan->total), ['class' => 'form-control', 'id'=>'total', 'min'=>0, 'disabled']) !!}
                                    {!! Form::Label('total', 'Total') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>

@endsection