<?php

namespace App\Http\Controllers\Admin;

use App\Models\Keluhan;
use App\Models\Teknisi;
use App\Models\Wilayah;
use App\Models\Kategori;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;

class KeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $dataKeluhan = Keluhan::join('tbl_pelanggan', 'tbl_keluhan.id_pelanggan', '=', 'tbl_pelanggan.id')
                            ->join('tbl_wilayah', 'tbl_pelanggan.id_wilayah', '=', 'tbl_wilayah.id')
                            ->join('tbl_kategori', 'tbl_keluhan.id_kategori', '=', 'tbl_kategori.id')
                            ->select('tbl_wilayah.wilayah', 'tbl_pelanggan.*', 'tbl_keluhan.*', 'tbl_kategori.kategori')
                            ->get();

            $dataTeknisi = Teknisi::all();

            if (request()->ajax()) {
                return view('keluhan.load', compact('dataKeluhan', 'dataTeknisi'));
            }

            return view('keluhan', compact('dataKeluhan', 'dataTeknisi'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $dataKategori = Kategori::all();
            $dataPelanggan = Pelanggan::all();

            if (request()->ajax()) {
                return view('_partials.modals.keluhan', compact('dataKategori', 'dataPelanggan'));
            }

            return view('admin.keluhan.create');
        } catch (\Throwable $th) {
            throw $th;
            // return $th->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Keluhan::create($request->all());

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menyimpan !'
                ]);
            }

            return redirect()->route('keluhan')->with('success', 'Berhasil Menyimpan !');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function show(Keluhan $keluhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluhan $keluhan)
    {
        try {
            $keluhan = Keluhan::join('tbl_kategori', 'tbl_keluhan.id_kategori', '=', 'tbl_kategori.id')
                    ->join('tbl_pelanggan', 'tbl_keluhan.id_pelanggan', '=', 'tbl_pelanggan.id')
                    ->select('tbl_keluhan.*', 'tbl_kategori.kategori', 'tbl_pelanggan.nama_pelanggan')
                    ->find($keluhan->id);

            $dataKategori = Kategori::all();
            $dataPelanggan = Pelanggan::all();

            if (request()->ajax()) {
                return view('_partials.modals.keluhan', compact('keluhan', 'dataKategori', 'dataPelanggan'));
            }

            return view('admin.keluhan.edit', compact('keluhan', 'dataKategori', 'dataPelanggan'));
        } catch (\Throwable $th) {
            throw $th;
            // return $th->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keluhan $keluhan)
    {
        try {
            $keluhan->update($request->all());

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Update !'
                ]);
            }

            return redirect()->route('keluhan')
                ->with('success', 'Berhasil Update !');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keluhan $keluhan)
    {
        try {
            $keluhan->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Hapus !'
                ]);
            }

            return redirect()->route('admin.pelanggan.index')->with('success', 'Berhasil Hapus !');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function updatedActivity()
    {
       $activity = Telegram::getUpdates();
       dd($activity);
    }
    
    public function send(Request $request, $id)
    {
        try {
            $id = $request->id;
            $deskripsi = $request->deskripsi;
            $penyebab = $request->penyebab;
            $id_pelanggan = $request->id_pelanggan;

            $keluhan = Keluhan::join('tbl_pelanggan', 'tbl_keluhan.id_pelanggan', '=', 'tbl_pelanggan.id')
                                    ->join('tbl_wilayah', 'tbl_pelanggan.id_wilayah', '=', 'tbl_wilayah.id')
                                    ->join('tbl_kategori', 'tbl_keluhan.id_kategori', '=', 'tbl_kategori.id')
                                    ->select('tbl_keluhan.*', 'tbl_pelanggan.*', 'tbl_wilayah.wilayah', 'tbl_kategori.kategori')
                                    ->where('tbl_keluhan.id_pelanggan', '=', $id_pelanggan)->first();

            // dd($keluhan->wilayah);
        $text = "Selamat Sejahtera Rekan, ada tiket info gangguan yang terjadi sebagai berikut :\n <b>Wilayah: </b> <u>$keluhan->wilayah</u>\n <b>Deskripsi: </b> $deskripsi\n <b>Penyebab: </b> $penyebab (kategori kerusakan: $keluhan->kategori)\n <b>Nomor Pelanggan: </b>\n <i>$id_pelanggan</i>\n"
            . "<b>Harap untuk rekan - rekan memberikan pesan dan update terus mengenai tiket tersebut dengan format berikut : </b>\n" .
                "#PRSP =  Persiapan Peralatan\n".  "#PRJLN  =  Dalam Perjalanan\n". "#PRGRS   =  Dalam Progres\n #Close = Selesai \n #Pending = Jika Ada Kendala \n". "\n Dengan Penulisan #Format-Nomor Tiket-Nama Teknisi\n #PRJLN-Nomor Tiket-Nama Teknisi\n #PRGRS-Nomor Tiket-Nama Teknisi\n #CLOSE/#Pending-Nama Tiket-Nama Teknisi"
            ;

            Telegram::sendMessage([
                'chat_id' => '-1001534767135',
                'parse_mode' => 'HTML',
                'text' => $text
            ]);

            $keluhan = Keluhan::find($id);
            $keluhan->update([
                'status' => 2,
            ]);

            return redirect()->back()->with('success', 'Berhasil kirim pesan !');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
