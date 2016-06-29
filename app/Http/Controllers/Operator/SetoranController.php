<?php

namespace App\Http\Controllers\Operator;

use App\Models\Pasar;
use App\Models\Pegawai;
use App\Models\Pungutan;
use App\Plugins\Helper;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;

class SetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (count($request->all())>0){

            return redirect()->route(
                'setoran.setor',
                [
                    'tgl'=>$request->tgl_pungutan,
                    'pasar'=>$request->id_pasar,
                    'petugas'=>$request->id_petugas
                ]);
        }
        $pasar = Pasar::pluck('nama_pasar', 'id')->all();
        //dd(Helper::selectData($pasar));
        return view('operator.setoran.form_date',['pasar'=>$pasar]);
    }

    public function getPetugas(Request $request)
    {
        if(isset($request->q)){
            $petugas = Pegawai::where('id_pasar',$request->id_pasar)
                ->whereRaw(DB::raw('nama_lengkap like \'%'.$request->q.'%\''))
                ->pluck('nama_lengkap','id_users')
                ->all();
        }else{
            $petugas = Pegawai::where('id_pasar',$request->id_pasar)->pluck('nama_lengkap','id_users')->all();
        }

        return json_encode(Helper::selectData($petugas));
    }

    public function setor($tgl, $pasar, $petugas)
    {
        //return $tgl.' '.$pasar.' '.$petugas;
        $pasar = Pasar::findOrFail($pasar);
        $petugas = User::findOrFail($petugas)->pegawai;
        $tgl_pungutan = date('Y-m-d',strtotime($tgl));

        $total = DB::table('pungutan AS p')
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
            ->select(DB::raw('p.id_pasar, p.id_dagang, p.tgl_pungutan, p.created_by, sum(h.total) AS total_harian, sum(b.total) AS total_bulanan'))
            ->where('p.created_by', $petugas->id_users)
            ->whereRaw('DATE_FORMAT(p.created_at,\'%Y%c%d\')=DATE_FORMAT(\''.$tgl_pungutan.'\',\'%Y%c%d\') AND p.deposited IS NULL')
            ->first();

        $pungutan = Pungutan::leftJoin(
                'pungutan_harian AS h',
                function($join){
                    $join->on('pungutan.id', '=', 'h.id_pungutan');
                }
            )
            ->leftJoin(
                'pungutan_bulanan AS b',
                function($join){
                    $join->on('pungutan.id', '=', 'b.id_pungutan');
                }
            )
            ->leftJoin(
                'dagang AS dg',
                function ($join){
                    $join->on('pungutan.id_dagang', '=', 'dg.id');
                }
            )
            ->select('pungutan.id','pungutan.type','pungutan.detail','pungutan.created_at','pungutan.deposited','pungutan.deposited_to','h.total AS total_harian', 'b.total AS total_bulanan', 'dg.nama_dagang')
            ->where('pungutan.created_by', $petugas->id_users)
            ->whereRaw('DATE_FORMAT(pungutan.created_at,\'%Y%c%d\')=DATE_FORMAT(\''.$tgl_pungutan.'\',\'%Y%c%d\') AND pungutan.deposited IS NULL')
            ->get();
        return view('operator.setoran.setor',[
            'pasar'=>$pasar,
            'petugas'=>$petugas,
            'tgl'=>$tgl,
            'total'=>$total,
            'pungutan'=>$pungutan
        ]);
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
    public function update(Request $request, $tgl, $pasar, $petugas)
    {
        $tgl_pungutan = date('Y-m-d',strtotime($tgl));
        $operator = Auth::user()->id;
        $pungutan = Pungutan::where('created_by', $petugas)
            ->where('id_pasar',$pasar)
            ->whereRaw('DATE_FORMAT(created_at,\'%Y%c%d\')=DATE_FORMAT(\''.$tgl_pungutan.'\',\'%Y%c%d\') AND deposited IS NULL')
            ->update(['deposited' => date("Y-m-d H:i:s", time()), 'deposited_to'=>$operator]);
        //dd($pungutan);
        Session::flash('success_message', 'Pungutan berhaisl disetor!');
        return redirect(url('/operator/setoran'));
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
