<?php

namespace App\Http\Controllers\Dirut;

use App\Models\Pasar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Yajra\Datatables\Datatables;

use App\Models\Dagang;
use App\Models\Komoditas;

class DagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dirut.dagang.grid");
    }

    public function dataTable()
    {
        $data = Dagang::join(
            'pasar',
            function($join){
                $join->on('dagang.id_pasar', '=', 'pasar.id');
            }
        )
        ->join(
            'komoditas',
            function($join){
                $join->on('dagang.id_komoditas', '=', 'komoditas.id');
            }
        )
        ->select([
            'dagang.id', 'dagang.nama_dagang', 'dagang.jenis_dagang', 'dagang.status', 'dagang.created_at', 'dagang.updated_at',
            'pasar.nama_pasar',
            'komoditas.nama_komoditas'
        ]);

        return Datatables::of($data)
            ->setRowClass(function ($data) {
                return 'row-'.$data->id;
            })
            ->editColumn('jenis_dagang', function($data){ return Dagang::getLabelJenis($data->jenis_dagang); })
            ->editColumn('status', function($data){ return Dagang::getLabelStatus($data->status); })
            ->editColumn('created_at', function($data){ return date('d F Y', strtotime($data->created_at)); })
            //->editColumn('updated_at', function($data){ return date('d F Y', strtotime($data->updated_at)); })
            ->addColumn('action', function ($data) {
                return '<a href="'.url('/dirut/dagang/edit')."/".$data->id.'" class="btn btn-icon-only blue" title="Edit"><i class="fa fa-pencil"></i></a>'
                .'<a href="javascript:del(\''.$data->id.'\');" class="btn btn-icon-only red btn-del" title="Edit"><i class="fa fa-trash"></i></a>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Dagang();
        $pasar = Pasar::pluck('nama_pasar', 'id');
        $komoditas = Komoditas::pluck('nama_komoditas', 'id');

        return view('dirut.dagang.create',['model'=>$model,'pasar'=>$pasar,'komoditas'=>$komoditas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Dagang();
        $validator = $model->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $model->id = $model->createId();
        $model->id_pasar = $request->id_pasar;
        $model->id_komoditas = $request->id_komoditas;
        $model->nama_dagang = ucwords($request->nama_dagang);
        $model->jenis_dagang = $request->jenis_dagang;
        $model->lokasi = $request->lokasi;
        $model->status = $model::STS_PENDING;
        $model->created_by = $user->id;
        $model->save();
        Session::flash('success_message', 'Data dagang successfully added!');

        return redirect()->back();
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
        $model = Dagang::findOrFail($id);
        $pasar = Pasar::pluck('nama_pasar', 'id');
        $komoditas = Komoditas::pluck('nama_komoditas', 'id');
        return view('dirut.dagang.update',['model'=>$model,'pasar'=>$pasar,'komoditas'=>$komoditas]);
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
        $model = Dagang::findOrFail($id);
        $validator = $model->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $model->id_pasar = $request->id_pasar;
        $model->id_komoditas = $request->id_komoditas;
        $model->nama_dagang = ucwords($request->nama_dagang);
        $model->jenis_dagang = $request->jenis_dagang;
        $model->lokasi = $request->lokasi;
        $model->updated_by = $user->id;
        $model->save();
        Session::flash('success_message', 'Data Dagang successfully updated!');

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
        Dagang::findOrFail($id)->delete();
    }
}
