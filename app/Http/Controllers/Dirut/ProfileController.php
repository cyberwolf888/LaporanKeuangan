<?php

namespace App\Http\Controllers\Dirut;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function index()
    {
        $model = Auth::user();
        return view('dirut.profile.account',['model'=>$model]);
    }

    public function overview(Request $request)
    {
        $user = Auth::user();
        $user->email = $request->email;
        if($user->save()){
            $user->pegawai->nama_lengkap = $request->nama_lengkap;
            $user->pegawai->no_telp = $request->no_telp;
            $user->pegawai->jenis_kelamin = $request->jenis_kelamin;
            $user->pegawai->alamat = $request->alamat;
            if($user->pegawai->save()){
                Session::flash('success_message', 'Overview profile successfully updated!');
                return redirect()->back();
            }
        }

    }

    public function avatar(Request $request)
    {
        if ($request->hasFile('photo')){
            $user = Auth::user();
            $image = $request->file('photo');
            $path = base_path().'\assets\photo';
            if($user->pegawai->photo != null){
                unlink($path."/".$user->pegawai->photo);
            }
            $ext = $image->getClientOriginalExtension();
            $fileName = $user->pegawai->id.str_random(10).".".$ext;
            $user->pegawai->photo = $fileName;
            if($user->pegawai->save()){
                $image->move($path, $fileName);
                Session::flash('success_message', 'Avatar profile successfully updated!');
                return redirect()->back();
            }
        }
    }

    public function password(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'password'  =>  'required|min:8|confirmed',
            'password_confirmation'  =>  'required|min:8',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->password = bcrypt($request->password);
        if($user->save()){
            $data = [
                'to' => $user->email,
                'from'=> env('MAIL_USERNAME'),
                'name' => 'Laporan Keuangan Denpasar',
                'subject' => 'New Account',
                'password' => $request->password,
                'username' => $user->email,
                'nama_lengkap'=> $user->pegawai->nama_lengkap
            ];

            Mail::send('mail.inline_new_account', $data, function ($message)  use ($data) {
                $message->from($data['from'], $data['name']);
                $message->to($data['to'])->subject($data['subject']);
            });

            Session::flash('success_message', 'Your password has been change!');
            return redirect()->back();
        }
    }
}
