<?php

namespace App\Http\Controllers\Dirut;

use App\Models\Pasar;
use App\Models\Pegawai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{

    public function dirut()
    {
        $model = User::where('type',User::DIRUT)->with('pegawai')->get();
        return view('dirut.pegawai.dirut.grid',['model'=>$model]);
    }

    public function createDirut()
    {
        $model = new User();
        return view('dirut.pegawai.dirut.create',['model'=>$model]);
    }

    public function storeDirut(Request $request)
    {
        $password = str_random(8);
        $user = new User();
        $pegawai = new Pegawai();

        $vUser = $user->validator($request->all());
        if ($vUser->fails()) {
            return redirect()->back()->withErrors($vUser)->withInput();
        }
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->status = $request->status;
        $user->type = User::DIRUT;
        if($user->save()){
            $pegawai->id = $pegawai->createId();
            $pegawai->id_users = $user->id;
            $pegawai->nama_lengkap = $request->nama_lengkap;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->alamat = $request->alamat;
            $pegawai->no_telp = $request->no_telp;
            $pegawai->created_by = Auth::user()->id;

            if($pegawai->save()){
                $user->roles()->attach(3);
                $data = [
                    'to' => $request->email,
                    'from' => 'awesome.advertiser@gmail.com',
                    'name' => 'Laporan Keuangan Denpasar',
                    'subject' => 'New Account',
                    'password' => $password,
                    'username' => $request->email,
                    'nama_lengkap'=> $request->nama_lengkap
                ];

                Mail::send('mail.inline_new_account', $data, function ($message)  use ($data) {
                    $message->from($data['from'], $data['name']);
                    $message->to($data['to'])->subject($data['subject']);
                });

                Session::flash('success_message', 'Account successfully created!');

                return redirect()->back();
            }
        }
    }

    public function editDirut($id)
    {
        $model = User::where('type',User::DIRUT)->with('pegawai')->find($id);
        return view('dirut.pegawai.dirut.update',['model'=>$model]);

    }

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

    ///////////////////////////////////// Operator /////////////////////////////////////////////////////

    public function operator()
    {
        $model = User::where('type',User::OPERATOR)->with('pegawai')->get();
        return view('dirut.pegawai.operator.grid',['model'=>$model]);
    }

    public function createOperator()
    {
        $model = new User();
        return view('dirut.pegawai.operator.create',['model'=>$model]);
    }

    public function storeOperator(Request $request)
    {
        $password = str_random(8);
        $user = new User();
        $pegawai = new Pegawai();

        $vUser = $user->validator($request->all());
        if ($vUser->fails()) {
            return redirect()->back()->withErrors($vUser)->withInput();
        }
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->status = $request->status;
        $user->type = User::OPERATOR;
        if($user->save()){
            $pegawai->id = $pegawai->createId();
            $pegawai->id_users = $user->id;
            $pegawai->nama_lengkap = $request->nama_lengkap;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->alamat = $request->alamat;
            $pegawai->no_telp = $request->no_telp;
            $pegawai->created_by = Auth::user()->id;

            if($pegawai->save()){
                $user->roles()->attach(2);
                $data = [
                    'to' => $request->email,
                    'from' => 'awesome.advertiser@gmail.com',
                    'name' => 'Laporan Keuangan Denpasar',
                    'subject' => 'New Account',
                    'password' => $password,
                    'username' => $request->email,
                    'nama_lengkap'=> $request->nama_lengkap
                ];

                Mail::send('mail.inline_new_account', $data, function ($message)  use ($data) {
                    $message->from($data['from'], $data['name']);
                    $message->to($data['to'])->subject($data['subject']);
                });

                Session::flash('success_message', 'Account successfully created!');

                return redirect()->back();
            }
        }
    }

    public function editOperator($id)
    {
        $model = User::where('type',User::OPERATOR)->with('pegawai')->find($id);
        return view('dirut.pegawai.operator.update',['model'=>$model]);

    }

    public function updateOperator(Request $request, $id)
    {
        $model = User::where('type',User::OPERATOR)->with('pegawai')->find($id);
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

    /////////////////////////////////////////////////// Petugas ////////////////////////////////////////////////

    public function petugas()
    {
        $model = User::where('type',User::PETUGAS)->with('pegawai')->get();
        return view('dirut.pegawai.petugas.grid',['model'=>$model]);
    }

    public function createPetugas()
    {
        $pasar = Pasar::pluck('nama_pasar', 'id')->all();
        $model = new User();
        return view('dirut.pegawai.petugas.create',['model'=>$model,'pasar'=>$pasar]);
    }

    public function storePetugas(Request $request)
    {
        $password = str_random(8);
        $user = new User();
        $pegawai = new Pegawai();

        $vUser = $user->validator($request->all());
        if ($vUser->fails()) {
            return redirect()->back()->withErrors($vUser)->withInput();
        }
        $user->email = $request->email;
        $user->password = bcrypt($password);
        $user->status = $request->status;
        $user->type = User::PETUGAS;
        if($user->save()){
            $pegawai->id = $pegawai->createId();
            $pegawai->id_users = $user->id;
            $pegawai->id_pasar = $request->id_pasar;
            $pegawai->nama_lengkap = $request->nama_lengkap;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->alamat = $request->alamat;
            $pegawai->no_telp = $request->no_telp;
            $pegawai->created_by = Auth::user()->id;

            if($pegawai->save()){
                $user->roles()->attach(1);
                $data = [
                    'to' => $request->email,
                    'from' => 'awesome.advertiser@gmail.com',
                    'name' => 'Laporan Keuangan Denpasar',
                    'subject' => 'New Account',
                    'password' => $password,
                    'username' => $request->email,
                    'nama_lengkap'=> $request->nama_lengkap
                ];

                Mail::send('mail.inline_new_account', $data, function ($message)  use ($data) {
                    $message->from($data['from'], $data['name']);
                    $message->to($data['to'])->subject($data['subject']);
                });

                Session::flash('success_message', 'Account successfully created!');

                return redirect()->back();
            }
        }
    }

    public function editPetugas($id)
    {
        $pasar = Pasar::pluck('nama_pasar', 'id')->all();
        $model = User::where('type',User::PETUGAS)->with('pegawai')->find($id);
        return view('dirut.pegawai.petugas.update',['model'=>$model,'pasar'=>$pasar]);

    }

    public function updatePetugas(Request $request, $id)
    {
        $model = User::where('type',User::PETUGAS)->with('pegawai')->find($id);
        //dd($model);
        $model->email = $request->email;
        $model->status = $request->status;
        $model->pegawai->id_pasar = $request->id_pasar;
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
}
