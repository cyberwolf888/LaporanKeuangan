<?php

namespace App\Http\Controllers\Operator;

use App\Models\Pasar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\Models\Dagang;
use Yajra\Datatables\Datatables;

class DagangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("operator.dagang.grid");
    }

    public function dataTable()
    {
        $pasar = Dagang::join(
            'pasar',
            function($join){
                $join->on('dagang.id_pasar', '=', 'pasar.id');
            }
        )
        ->join(
            'komoditas',
            function($join){
                $join->on('dagang.komoditas', '=', 'komoditas.id');
            }
        )
        ->select([
            'dagang.id', 'dagang.nama_dagang', 'dagang.jenis_dagang', 'dagang.status', 'dagang.created_at', 'dagang.updated_at',
            'pasar.nama_pasar',
            'komoditas.nama_komoditas'
        ]);

        return Datatables::of($pasar)
            ->setRowClass(function ($data) {
                return 'row-'.$data->id;
            })
            ->editColumn('jenis_dagang', function($data){ return Dagang::getLabelJenis($data->jenis_dagang); })
            ->editColumn('status', function($data){ return Dagang::getLabelStatus($data->status); })
            ->editColumn('created_at', function($data){ return date('d F Y', strtotime($data->created_at)); })
            //->editColumn('updated_at', function($data){ return date('d F Y', strtotime($data->updated_at)); })
            ->addColumn('action', function ($data) {
                return '<a href="'.url('/operator/dagang/edit')."/".$data->id.'" class="btn btn-icon-only blue" title="Edit"><i class="fa fa-pencil"></i></a>'
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
        return view('operator.dagang.create',['model'=>$model]);
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
