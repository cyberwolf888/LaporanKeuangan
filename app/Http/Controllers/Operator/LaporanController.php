<?php

namespace App\Http\Controllers\Operator;

use App\Models\Pasar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexKeuangan(Request $request)
    {
        if(count($request->all())>0){
            return redirect()->route('laporan.result',[
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'pasar'=>$request->id_pasar,
                'sts_pungutan'=>$request->sts_pungutan
            ]);
        }
        $pasar = Pasar::pluck('nama_pasar', 'id')->all();
        return view('operator.laporan.keuangan.form_date',['pasar'=>$pasar]);
    }

    public function result($start_date, $end_date, $pasar, $sts_pungutan)
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
            ->select(DB::raw('p.id_pasar, p.id_dagang, p.tgl_pungutan, p.created_by, sum(h.total) AS total_harian, sum(b.total) AS total_bulanan'));
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
            ->select(DB::raw('p.id, p.id_pasar, p.id_dagang, p.type, p.deposited, p.detail, p.created_at,
                              h.total AS total_harian,
                              b.total AS total_bulanan,
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

        $total = $q_total->first();
        $detail = $q_detail->get();

        return $pasar;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
