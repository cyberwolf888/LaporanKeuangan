<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\Controller;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createHarian()
    {
        $id_pasar = Auth::user()->pegawai->id_pasar;
        $date = date("Y-m-d");
        $pungutan = new Pungutan();
        $harian = new PungutanHarian();
        $dagang = Dagang::leftJoin(DB::raw('(SELECT * FROM pungutan WHERE DATE_FORMAT(created_at,\'%Y%c%d\')=DATE_FORMAT(now(),\'%Y%c%d\')) AS p'), 'dagang.id', '=', 'p.id_dagang')
            ->whereRaw('dagang.id_pasar = "'.$id_pasar.'" AND p.id_dagang IS NULL')
            ->pluck('dagang.nama_dagang','dagang.id');
        $tarif = new Tarif();


        return view("petugas.pungutan.harian.create",[
            'pungutan'=>$pungutan,
            'harian'=>$harian,
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
        $pungutan->type = $pungutan::T_PUNGUTAN;
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
        //
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
        return "bulanan";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBulanan()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBulanan(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBulanan($id)
    {
        //
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
}
