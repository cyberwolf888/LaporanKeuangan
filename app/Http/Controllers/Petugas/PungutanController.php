<?php

namespace App\Http\Controllers\Petugas;

use App\Models\PungutanBulanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\Models\Pungutan;
use App\Models\PungutanHarian;
use App\Models\Dagang;
use App\Models\Pasar;
use App\Models\Tarif;
use Illuminate\Support\Facades\Auth;


class PungutanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexHarian()
    {
        return view("petugas.pungutan.harian.grid");
    }
    public function dataTableHarian()
    {
        $data = Pungutan::join(
            'pungutan_harian AS h',
            function($join){
                $join->on('pungutan.id', '=', 'h.id_pungutan');
            }
        )
            ->join(
                'pasar AS ps',
                function($join){
                    $join->on('pungutan.id_pasar', '=', 'ps.id');
                }
            )
            ->join(
                'dagang AS dg',
                function($join){
                    $join->on('pungutan.id_dagang', '=', 'dg.id');
                }
            )
            ->select([
                'pungutan.id','pungutan.type','pungutan.deposited','pungutan.deposited_to','pungutan.created_by','pungutan.tgl_pungutan', 'h.total', 'ps.nama_pasar', 'dg.nama_dagang'
            ])
            ->where('pungutan.detail',Pungutan::D_HARIAN)
            ->where('pungutan.created_by', Auth::user()->id);
        return Datatables::of($data)
            ->setRowClass(function ($data) {
                return 'row-'.$data->id;
            })
            ->editColumn('deposited', function($data){ return $data->deposited == '' ? '-' : $data->deposited; })
            ->editColumn('total', function($data){ return 'Rp. '.number_format($data->total,0,',','.'); })
            ->editColumn('type', function($data){ return $data->getLabelType($data->type); })
            ->addColumn('action', function ($data) {
                return '<a href="'.url('/petugas/pungutan/harian/detail')."/".$data->id.'" class="btn btn-icon-only purple" title="Detail"><i class="fa fa-file-text"></i></a>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createHarian()
    {
        $id_pasar = Auth::user()->pegawai->id_pasar;
        $pungutan = new Pungutan();
        $dagang = Dagang::leftJoin(DB::raw('(SELECT * FROM pungutan WHERE DATE_FORMAT(tgl_pungutan,\'%Y%c%d\')=DATE_FORMAT(now(),\'%Y%c%d\') AND detail=\''.$pungutan::D_HARIAN.'\') AS p'), 'dagang.id', '=', 'p.id_dagang')
            ->whereRaw('dagang.id_pasar = "'.$id_pasar.'" AND dagang.status = "'.Dagang::STS_APROVED.'" AND p.id_dagang IS NULL')
            ->pluck('dagang.nama_dagang','dagang.id');
        $tarif = new Tarif();

        return view("petugas.pungutan.harian.create",[
            'pungutan'=>$pungutan,
            'id_pasar'=>$id_pasar,
            'dagang'=>$dagang,
            'tarif'=>$tarif
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeHarian(Request $request)
    {
        $pungutan = new Pungutan();
        $harian = new PungutanHarian();

        $vPungutan = $pungutan->validator($request->all());
        $vHarian = $harian->validator($request->all());
        if ($vPungutan->fails()) {
            return redirect()->back()->withErrors($vPungutan)->withInput();
        }
        if ($vHarian->fails()) {
            return redirect()->back()->withErrors($vHarian)->withInput();
        }

        $pungutan->id_pasar = Auth::user()->pegawai->id_pasar;
        $pungutan->id_dagang = $request->id_dagang;
        $pungutan->tgl_pungutan = date("Y-m-d");
        $pungutan->type = $pungutan::T_PUNGUTAN;
        $pungutan->detail = $pungutan::D_HARIAN;
        $pungutan->created_by = Auth::user()->id;

        if($pungutan->save()){
            $harian->id_pungutan = $pungutan->id;
            $harian->tempat_berjualan = $request->tempat_berjualan;
            $harian->listrik = $request->listrik;
            $harian->air = $request->air;
            $harian->jumlah = $request->tempat_berjualan + $request->listrik + $request->air;
            $harian->ppn = $harian->jumlah * 10/100;
            $harian->total = $harian->jumlah + $harian->ppn;
            $harian->created_by = Auth::user()->id;
            if($harian->save()){
                Session::flash('success_message', 'Pungutan successfully added!');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showHarian($id)
    {
        $model = Pungutan::where('id',$id)->where('detail',Pungutan::D_HARIAN)->firstOrFail();
        return view('petugas.pungutan.harian.detail',['model'=>$model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editHarian($id)
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
    public function updateHarian(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyHarian($id)
    {
        //
    }

    ///////////////////////////////////////////////// BULANAN /////////////////////////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBulanan()
    {
        return view("petugas.pungutan.bulanan.grid");
    }
    public function dataTableBulanan()
    {
        $data = Pungutan::join(
            'pungutan_bulanan AS h',
            function($join){
                $join->on('pungutan.id', '=', 'h.id_pungutan');
            }
        )
            ->join(
                'pasar AS ps',
                function($join){
                    $join->on('pungutan.id_pasar', '=', 'ps.id');
                }
            )
            ->join(
                'dagang AS dg',
                function($join){
                    $join->on('pungutan.id_dagang', '=', 'dg.id');
                }
            )
            ->select([
                'pungutan.id','pungutan.type','pungutan.deposited','pungutan.deposited_to','pungutan.created_by','pungutan.tgl_pungutan', 'h.total', 'ps.nama_pasar', 'dg.nama_dagang'
            ])
            ->where('pungutan.detail',Pungutan::D_BULANAN)
            ->where('pungutan.created_by', Auth::user()->id);
        return Datatables::of($data)
            ->setRowClass(function ($data) {
                return 'row-'.$data->id;
            })
            ->editColumn('deposited', function($data){ return $data->deposited == '' ? '-' : $data->deposited; })
            ->editColumn('total', function($data){ return 'Rp. '.number_format($data->total,0,',','.'); })
            ->editColumn('type', function($data){ return $data->getLabelType($data->type); })
            ->addColumn('action', function ($data) {
                return '<a href="'.url('/petugas/pungutan/bulanan/detail')."/".$data->id.'" class="btn btn-icon-only purple" title="Detail"><i class="fa fa-file-text"></i></a>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBulanan()
    {
        $id_pasar = Auth::user()->pegawai->id_pasar;
        $pungutan = new Pungutan();
        $dagang = Dagang::leftJoin(DB::raw('(SELECT * FROM pungutan WHERE DATE_FORMAT(tgl_pungutan,\'%Y%c\')=DATE_FORMAT(now(),\'%Y%c\') AND detail=\''.$pungutan::D_BULANAN.'\') AS p'), 'dagang.id', '=', 'p.id_dagang')
            ->whereRaw('dagang.id_pasar = "'.$id_pasar.'" AND dagang.status = "'.Dagang::STS_APROVED.'" AND p.id_dagang IS NULL')
            ->pluck('dagang.nama_dagang','dagang.id');
        $tarif = new Tarif();

        return view("petugas.pungutan.bulanan.create",[
            'pungutan'=>$pungutan,
            'id_pasar'=>$id_pasar,
            'dagang'=>$dagang,
            'tarif'=>$tarif
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBulanan(Request $request)
    {
        $pungutan = new Pungutan();
        $bulanan = new PungutanBulanan();

        $vPungutan = $pungutan->validator($request->all());
        $vBulanan = $bulanan->validator($request->all());
        if ($vPungutan->fails()) {
            return redirect()->back()->withErrors($vPungutan)->withInput();
        }
        if ($vBulanan->fails()) {
            return redirect()->back()->withErrors($vBulanan)->withInput();
        }

        $pungutan->id_pasar = Auth::user()->pegawai->id_pasar;
        $pungutan->id_dagang = $request->id_dagang;
        $pungutan->tgl_pungutan = date("Y-m-d");
        $pungutan->type = $pungutan::T_PUNGUTAN;
        $pungutan->detail = $pungutan::D_BULANAN;
        $pungutan->created_by = Auth::user()->id;

        if($pungutan->save()){
            $bulanan->id_pungutan = $pungutan->id;
            $bulanan->sewa_tempat = $request->sewa_tempat;
            $bulanan->ppn = $bulanan->sewa_tempat * 10/100;
            $bulanan->total = $bulanan->sewa_tempat + $bulanan->ppn;
            $bulanan->created_by = Auth::user()->id;
            if($bulanan->save()){
                Session::flash('success_message', 'Pungutan successfully added!');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBulanan($id)
    {
        $model = Pungutan::where('id',$id)->where('detail',Pungutan::D_BULANAN)->firstOrFail();
        return view('petugas.pungutan.bulanan.detail',['model'=>$model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editBulanan($id)
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
    public function updateBulanan(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyBulanan($id)
    {
        //
    }

    ////////////////////////////////////////////// TUNGGAKAN ///////////////////////////////////////////////////////////
    public function createTunggakanHarian($date = null)
    {
        $id_pasar = Auth::user()->pegawai->id_pasar;
        $tarif = new Tarif();
        if($date){
            $carbon = Carbon::createFromFormat('d-m-Y', $date);
            $dagang = Dagang::leftJoin(DB::raw('(SELECT * FROM pungutan WHERE tgl_pungutan = \''.$carbon->format('Y-m-d').'\' AND pungutan.detail=\''.Pungutan::D_HARIAN.'\') AS pungutan'), 'dagang.id', '=', 'pungutan.id_dagang')
                ->whereRaw('dagang.id_pasar = "'.$id_pasar.'" AND dagang.status = "'.Dagang::STS_APROVED.'" AND pungutan.tgl_pungutan IS NULL')
                ->pluck('dagang.nama_dagang','dagang.id');
            if($dagang->count()==0){
                Session::flash('error_message', 'Tidak ada dagang yang menunggak pada tanggal '.$carbon->format('d F Y'));
                return redirect()->back();
            }
        }else{
            $dagang = null;
        }
        return view('petugas.pungutan.harian.tunggakan',[
            'id_pasar'=>$id_pasar,
            'tarif'=>$tarif,
            'dagang'=>$dagang,
            'date'=>$date
        ]);
    }
    public function storeTunggakanHarian(Request $request)
    {
        $pungutan = new Pungutan();
        $harian = new PungutanHarian();

        $vPungutan = $pungutan->validator($request->all());
        $vHarian = $harian->validator($request->all());
        if ($vPungutan->fails()) {
            return redirect()->back()->withErrors($vPungutan)->withInput();
        }
        if ($vHarian->fails()) {
            return redirect()->back()->withErrors($vHarian)->withInput();
        }

        $pungutan->id_pasar = Auth::user()->pegawai->id_pasar;
        $pungutan->id_dagang = $request->id_dagang;
        $pungutan->tgl_pungutan = $request->tgl_pungutan;
        $pungutan->type = $pungutan::T_TUNGGAKAN;
        $pungutan->detail = $pungutan::D_HARIAN;
        $pungutan->created_by = Auth::user()->id;

        if($pungutan->save()){
            $harian->id_pungutan = $pungutan->id;
            $harian->tempat_berjualan = $request->tempat_berjualan;
            $harian->listrik = $request->listrik;
            $harian->air = $request->air;
            $harian->jumlah = $request->tempat_berjualan + $request->listrik + $request->air;
            $harian->ppn = $harian->jumlah * 10/100;
            $harian->total = $harian->jumlah + $harian->ppn;
            $harian->created_by = Auth::user()->id;
            if($harian->save()){
                Session::flash('success_message', 'Tunggakan successfully added!');
                return redirect("/petugas/tunggakan/harian/create");
            }
        }
    }

    public function createTunggakanBulanan($date = null)
    {
        $id_pasar = Auth::user()->pegawai->id_pasar;
        $tarif = new Tarif();
        if($date){
            $carbon = Carbon::createFromFormat('m-Y', $date);
            $dagang = Dagang::leftJoin(DB::raw('(SELECT * FROM pungutan WHERE DATE_FORMAT(tgl_pungutan,\'%Y%c\')=DATE_FORMAT(\''.$carbon->format('Y-m-d').'\',\'%Y%c\') AND pungutan.detail=\''.Pungutan::D_BULANAN.'\') AS pungutan'), 'dagang.id', '=', 'pungutan.id_dagang')
                ->whereRaw('dagang.id_pasar = "'.$id_pasar.'" AND dagang.status = "'.Dagang::STS_APROVED.'" AND pungutan.tgl_pungutan IS NULL')
                ->pluck('dagang.nama_dagang','dagang.id');
            if($dagang->count()==0){
                Session::flash('error_message', 'Tidak ada dagang yang menunggak pada tanggal '.$carbon->format('F Y'));
                return redirect()->back();
            }
        }else{
            $dagang = null;
        }
        return view('petugas.pungutan.bulanan.tunggakan',[
            'id_pasar'=>$id_pasar,
            'tarif'=>$tarif,
            'dagang'=>$dagang,
            'date'=>$date
        ]);
    }
    public function storeTunggakanBulanan(Request $request)
    {
        $pungutan = new Pungutan();
        $bulanan = new PungutanBulanan();

        $vPungutan = $pungutan->validator($request->all());
        $vBulanan = $bulanan->validator($request->all());
        if ($vPungutan->fails()) {
            return redirect()->back()->withErrors($vPungutan)->withInput();
        }
        if ($vBulanan->fails()) {
            return redirect()->back()->withErrors($vBulanan)->withInput();
        }
        $pungutan->id_pasar = Auth::user()->pegawai->id_pasar;
        $pungutan->id_dagang = $request->id_dagang;
        $pungutan->tgl_pungutan = $request->tgl_pungutan;
        $pungutan->type = $pungutan::T_TUNGGAKAN;
        $pungutan->detail = $pungutan::D_BULANAN;
        $pungutan->created_by = Auth::user()->id;

        if($pungutan->save()){
            $bulanan->id_pungutan = $pungutan->id;
            $bulanan->sewa_tempat = $request->sewa_tempat;
            $bulanan->ppn = $bulanan->sewa_tempat * 10/100;
            $bulanan->total = $bulanan->sewa_tempat + $bulanan->ppn;
            $bulanan->created_by = Auth::user()->id;
            if($bulanan->save()){
                Session::flash('success_message', 'Tunggakan successfully added!');
                return redirect("/petugas/tunggakan/bulanan/create");
            }
        }
    }
}
