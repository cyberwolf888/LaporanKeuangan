<?php

namespace App\Http\Controllers\Operator;

use App\Models\Dagang;
use App\Models\Pasar;
use App\Models\Pungutan;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $total_pasar = Pasar::count();
        $total_petugas = User::where('type', User::PETUGAS)->count();
        $total_pedagang = Dagang::count();
        $pedagang_baru = Dagang::whereRaw('month(created_at) = "' . date('m') . '"')->count();

        $revenue = [];
        $dagang = [];
        for ($i = 1; $i <= 12; $i++) {
            $pungutan = Pungutan::leftJoin(
                'pungutan_harian AS ph',
                function ($join) {
                    $join->on('pungutan.id', '=', 'ph.id_pungutan');
                }
            )
                ->leftJoin(
                    'pungutan_bulanan AS pb',
                    function ($join) {
                        $join->on('pungutan.id', '=', 'pb.id_pungutan');
                    }
                )
                ->select(DB::raw('SUM(ph.total) AS total_harian, SUM(pb.total) AS total_bulanan'))
                ->whereRaw('month(pungutan.created_at) = \'' . $i . '\' and year(pungutan.created_at) = \'' . date('Y') . '\'')
                ->first();
            array_push($revenue, $pungutan->total_harian + $pungutan->total_bulanan);

            $total_dagang = Dagang::whereRaw('month(created_at) = "' . $i . '" and year(created_at) = "' . date('Y') . '"')->count();
            array_push($dagang, $total_dagang);
        }
        return view('operator.dashboard.home', [
            'total_pasar' => $total_pasar,
            'total_petugas' => $total_petugas,
            'total_pedagang' => $total_pedagang,
            'pedagang_baru' => $pedagang_baru,
            'revenue' => $revenue,
            'dagang' => $dagang
        ]);
    }
}
