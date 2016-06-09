<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\Models\Komoditas;
use Yajra\Datatables\Datatables;

class KomoditasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.komoditas.grid');
    }
    public function dataTable()
    {
        $model = Komoditas::join('pegawai', 'komoditas.created_by', '=', 'pegawai.id_users')
            ->select(['komoditas.id', 'komoditas.nama_komoditas', 'pegawai.nama_lengkap', 'komoditas.created_at', 'komoditas.updated_at']);

        return Datatables::of($model)
            ->setRowClass(function ($data) {
                return 'row-'.$data->id;
            })
            ->editColumn('created_at', function($data){ return date('d F Y', strtotime($data->created_at)); })
            ->editColumn('updated_at', function($data){ return date('d F Y', strtotime($data->updated_at)); })
            ->addColumn('action', function ($data) {
                return '<a href="'.url('/operator/komoditas/edit')."/".$data->id.'" class="btn btn-icon-only blue" title="Edit"><i class="fa fa-pencil"></i></a>'
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
        $model = new Komoditas();
        return view('operator.komoditas.create', ['model'=>$model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Komoditas();
        $validator = $model->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $model->nama_komoditas = ucwords($request->nama_komoditas);
        $model->created_by = $user->id;
        $model->save();
        Session::flash('success_message', 'Data Komoditas successfully added!');

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
        $model = Komoditas::findOrFail($id);
        return view('operator.komoditas.update',['model'=>$model]);
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
        $model = Komoditas::findOrFail($id);
        $validator = $model->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $model->nama_komoditas = ucwords($request->nama_komoditas);
        $model->updated_by = $user->id;
        $model->save();
        Session::flash('success_message', 'Data Komoditas successfully updated!');

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
        Komoditas::destroy($id);
    }
}
