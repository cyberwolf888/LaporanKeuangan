<?php

namespace App\Http\Controllers\Operator;

use App\Models\Komoditas;
use App\Models\Pasar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function indexKeuangan(Request $request)
    {
        if(count($request->all())>0){
            return redirect()->route('laporan.resultKeuangan',[
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'pasar'=>$request->id_pasar,
                'sts_pungutan'=>$request->sts_pungutan
            ]);
        }
        $pasar = Pasar::pluck('nama_pasar', 'id')->all();
        return view('operator.laporan.keuangan.form_date',['pasar'=>$pasar]);
    }

    public function resultKeuangan($start_date, $end_date, $pasar, $sts_pungutan)
    {
        $tgl_start = date('Y-m-d',strtotime($start_date));
        $tgl_end = date('Y-m-d',strtotime($end_date));
        $q_total = DB::table('pungutan AS p')
            ->leftJoin(
                'pungutan_harian AS h',
                function($join){
                    $join->on('p.id', '=', 'h.id_pungutan');
                }
            )
            ->leftJoin(
                'pungutan_bulanan AS b',
                function($join){
                    $join->on('p.id', '=', 'b.id_pungutan');
                }
            )
            ->select(DB::raw('p.id_pasar, p.id_dagang, p.tgl_pungutan, p.created_by, sum(h.total) AS total_harian,
                              sum(h.tempat_berjualan) AS total_tempat_berjualan,
                              sum(h.listrik) AS total_listrik,
                              sum(h.air) AS total_air,
                              sum(h.ppn) AS total_ppn_harian,
                              sum(b.total) AS total_bulanan,
                              sum(b.sewa_tempat) AS total_sewa_tempat_bulanan,
                              sum(b.ppn) AS total_ppn_bulanan'));
        $q_detail = DB::table('pungutan AS p')
            ->leftJoin(
                'pungutan_harian AS h',
                function($join){
                    $join->on('p.id', '=', 'h.id_pungutan');
                }
            )
            ->leftJoin(
                'pungutan_bulanan AS b',
                function($join){
                    $join->on('p.id', '=', 'b.id_pungutan');
                }
            )
            ->leftJoin(
                'pasar AS ps',
                function($join){
                    $join->on('p.id_pasar', '=', 'ps.id');
                }
            )
            ->leftJoin(
                'dagang AS dg',
                function($join){
                    $join->on('p.id_dagang', '=', 'dg.id');
                }
            )
            ->leftJoin(
                'pegawai AS pg',
                function($join){
                    $join->on('p.created_by', '=', 'pg.id_users');
                }
            )
            ->leftJoin(
                'pegawai AS op',
                function($join){
                    $join->on('p.deposited_to', '=', 'op.id_users');
                }
            )
            ->select(DB::raw('p.id, p.tgl_pungutan, p.id_pasar, p.id_dagang, p.type, p.deposited, p.detail, p.created_at,
                              h.total AS total_harian,
                              h.tempat_berjualan,
                              h.listrik,
                              h.air,
                              h.ppn AS ppn_harian,
                              b.total AS total_bulanan,
                              b.sewa_tempat,
                              b.ppn as ppn_bulanan,
                              ps.nama_pasar,
                              dg.nama_dagang,
                              pg.id AS id_petugas,
                              pg.nama_lengkap AS nama_petugas,
                              op.id AS id_operator,
                              op.nama_lengkap AS nama_operator'));
        if($pasar != '0'){
            $q_total->where('p.id_pasar',$pasar);
            $q_detail->where('p.id_pasar',$pasar);
        }
        if($sts_pungutan == '1'){
            $q_total->whereRaw('p.deposited IS NOT NULL');
            $q_detail->whereRaw('p.deposited IS NOT NULL');
        }elseif ($sts_pungutan == '2'){
            $q_total->whereRaw('p.deposited IS NULL');
            $q_detail->whereRaw('p.deposited IS NULL');
        }

        $q_total->whereRaw('DATE_FORMAT(p.created_at,\'%Y%c%d\') BETWEEN DATE_FORMAT(\''.$tgl_start.'\',\'%Y%c%d\') AND DATE_FORMAT(\''.$tgl_end.'\',\'%Y%c%d\')');
        $q_detail->whereRaw('DATE_FORMAT(p.created_at,\'%Y%c%d\') BETWEEN DATE_FORMAT(\''.$tgl_start.'\',\'%Y%c%d\') AND DATE_FORMAT(\''.$tgl_end.'\',\'%Y%c%d\')');
        $q_detail->orderBy('p.created_at', 'desc');

        $total = $q_total->first();
        $detail = $q_detail->get();

        return view('operator.laporan.keuangan.result',[
            'total'=>$total,
            'detail'=>$detail,
            'start_date'=>$start_date,
            'end_date'=>$end_date
        ]);
    }

    public function indexDagang(Request $request)
    {
        if(count($request->all())>0){
            return redirect()->route('laporan.resultDagang',[
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'pasar'=>$request->id_pasar,
                'komoditas'=>$request->id_komoditas,
                'sts_dagang'=>$request->sts_dagang
            ]);
        }
        $pasar = Pasar::pluck('nama_pasar', 'id')->all();
        $komoditas = Komoditas::pluck('nama_komoditas', 'id')->all();
        return view('operator.laporan.dagang.form_date',['pasar'=>$pasar, 'komoditas'=>$komoditas]);
    }
    public function resultDagang($start_date, $end_date, $pasar, $komoditas, $sts_dagang)
    {
        $tgl_start = date('Y-m-d',strtotime($start_date));
        $tgl_end = date('Y-m-d',strtotime($end_date));

        $q_detail = DB::table('dagang AS d')
            ->join(
                'komoditas AS k',
                function($join){
                    $join->on('d.id_komoditas', '=', 'k.id');
                }
            )
            ->join(
                'pasar AS p',
                function($join){
                    $join->on('d.id_pasar', '=', 'p.id');
                }
            )->select(DB::raw('d.id,d.id_pasar,d.id_komoditas,d.nama_dagang,d.jenis_dagang,d.status,d.created_at,
                              k.nama_komoditas,
                              p.nama_pasar'));
        if($pasar != '0'){
            $q_detail->where('d.id_pasar',$pasar);
        }
        if($komoditas != '0'){
            $q_detail->where('d.id_komoditas',$komoditas);
        }
        if($sts_dagang != '0'){
            $q_detail->where('d.status',$sts_dagang);
        }
        $q_detail->whereRaw('DATE_FORMAT(d.created_at,\'%Y%c%d\') BETWEEN DATE_FORMAT(\''.$tgl_start.'\',\'%Y%c%d\') AND DATE_FORMAT(\''.$tgl_end.'\',\'%Y%c%d\')');
        $q_detail->orderBy('d.created_at', 'desc');
        $detail = $q_detail->get();

        return view('operator.laporan.dagang.result',[
            'detail'=>$detail,
            'start_date'=>$start_date,
            'end_date'=>$end_date
        ]);
    }
}
