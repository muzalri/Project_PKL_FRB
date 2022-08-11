<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function dashboardAdmin()
    {
        return view('admin.dashboard');
    }

    public function dashboardTeknisi()
    {
        return view('teknisi.dashboard');
    }

    public function keluhan()
    {
        $keluhan = Keluhan::all();
        
        $dataKeluhan = DB::table('tbl_keluhan')
                        ->join('tbl_pelanggan', 'tbl_keluhan.id_pelanggan', '=', 'tbl_pelanggan.id')
                        ->join('tbl_kategori', 'tbl_keluhan.id_kategori', '=', 'tbl_kategori.id')
                        ->join('tbl_teknisi', 'tbl_keluhan.id_teknisi', '=', 'tbl_teknisi.id')
                        ->get();

        return view('keluhan', compact('dataKeluhan'));
    }
}
