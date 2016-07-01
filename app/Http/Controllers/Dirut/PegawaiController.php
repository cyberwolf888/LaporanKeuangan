<?php

namespace App\Http\Controllers\Dirut;

use App\User;
use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dirut()
    {
        $model = User::where('type',User::DIRUT)->with('pegawai')->get();
        //dd($model);
        return view('dirut.pegawai.dirut.grid',['model'=>$model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDirut()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDirut(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDirut($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editDirut($id)
    {
        $model = User::where('type',User::DIRUT)->with('pegawai')->find($id);
        return view('dirut.pegawai.dirut.update',['model'=>$model]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDirut(Request $request, $id)
    {
        $model = User::where('type',User::DIRUT)->with('pegawai')->find($id);
        //dd($model);
        $model->email = $request->email;
        $model->status = $request->status;
        $model->pegawai->nama_lengkap = $request->nama_lengkap;
        $model->pegawai->no_telp = $request->no_telp;
        $model->pegawai->jenis_kelamin = $request->jenis_kelamin;
        $model->pegawai->alamat = $request->alamat;
        if($model->save()){
            $model->pegawai->save();
        }
        Session::flash('success_message', 'Data pegawai successfully updated!');
        return redirect()->back();
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
