<?php

namespace App\Http\Controllers\Dirut;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\Models\Pasar;
use Yajra\Datatables\Datatables;

class PasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dirut.pasar.grid');
    }
    public function dataTable()
    {
        $pasar = Pasar::join('pegawai', 'pasar.created_by', '=', 'pegawai.id_users')
            ->select(['pasar.id', 'pasar.nama_pasar', 'pegawai.nama_lengkap', 'pasar.created_at', 'pasar.updated_at']);

        return Datatables::of($pasar)
            ->setRowClass(function ($data) {
                return 'row-'.$data->id;
            })
            ->editColumn('created_at', function($data){ return date('d F Y', strtotime($data->created_at)); })
            ->editColumn('updated_at', function($data){ return date('d F Y', strtotime($data->updated_at)); })
            ->addColumn('action', function ($data) {
                return '<a href="'.url('/dirut/pasar/edit')."/".$data->id.'" class="btn btn-icon-only blue" title="Edit"><i class="fa fa-pencil"></i></a>'
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
        $model = new Pasar();
        return view('dirut.pasar.create', ['model'=>$model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Pasar();
        $validator = $model->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $model->id = $model->createId();
        $model->nama_pasar = ucwords($request->nama_pasar);
        $model->created_by = $user->id;
        $model->save();
        Session::flash('success_message', 'Data Pasar successfully added!');

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
        $model = Pasar::findOrFail($id);
        return view('dirut.pasar.update',['model'=>$model]);
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
        $model = Pasar::findOrFail($id);
        $validator = $model->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $model->nama_pasar = ucwords($request->nama_pasar);
        $model->updated_by = $user->id;
        $model->save();
        Session::flash('success_message', 'Data Pasar successfully updated!');

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
        Pasar::findOrFail($id)->delete();
    }
}
