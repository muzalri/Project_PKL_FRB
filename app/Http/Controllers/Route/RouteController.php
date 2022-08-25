<?php

namespace App\Http\Controllers\Route;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\Teknisi;
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
        try {
            $keluhan = Keluhan::all();
        
            $dataKeluhan = Keluhan::join('tbl_pelanggan', 'tbl_keluhan.id_pelanggan', '=', 'tbl_pelanggan.id')
                            ->join('tbl_wilayah', 'tbl_pelanggan.id_wilayah', '=', 'tbl_wilayah.id')
                            ->join('tbl_kategori', 'tbl_keluhan.id_kategori', '=', 'tbl_kategori.id')
                            ->select('tbl_wilayah.wilayah', 'tbl_pelanggan.*', 'tbl_keluhan.*', 'tbl_kategori.kategori')
                            ->get();

            $teknisis = Teknisi::all();

            return view('keluhan', compact('dataKeluhan', 'teknisis'));
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
