<?php

namespace App\Http\Controllers\Admin;

use App\Models\Wilayah;
use App\Models\Pelanggan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pelanggan = Pelanggan::all();
            
            $dataPelanggan = Pelanggan::join('tbl_wilayah', 'tbl_pelanggan.id_wilayah', '=', 'tbl_wilayah.id')
                                ->select('tbl_pelanggan.*', 'tbl_wilayah.wilayah')
                                ->get();

            if (request()->ajax()) {
                return view('admin.pelanggan.load', compact('dataPelanggan'));
            }

            return view('admin.pelanggan.index', compact('dataPelanggan'));
        } catch (\Throwable $th) {
            //throw $th;
            if (request()->ajax()) {
                return $this->error('Error ' . $th->getMessage());
            }
            return back()->with('error', 'Error ' . $th->getMessage());
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
            $dataWilayah = Wilayah::all();

            if (request()->ajax()) {
                return view('_partials.modals.pelanggan', compact('dataWilayah'));
            }

            return view('admin.pelanggan.create');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
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
            $random = Str::random(10);
            Pelanggan::create([
                'id' => $random,
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'id_wilayah' => $request->id_wilayah,
                'status' => '1',
            ]);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menyimpan !'
                ]);
            }

            return redirect()->route('admin.pelanggan.index')->with('success', 'Berhasil Menyimpan !');
        } catch (\Throwable $th) {
            throw $th->getMessage();
            // return $th->getMessage();
        }
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
        try {
            $pelanggan = Pelanggan::join('tbl_wilayah', 'tbl_pelanggan.id_wilayah', '=', 'tbl_wilayah.id')
                                            ->select('tbl_pelanggan.*', 'tbl_wilayah.wilayah')
                                            ->find($id);

            $dataWilayah = Wilayah::all();

            if (request()->ajax()) {
                return view('_partials.modals.pelanggan', compact('pelanggan', 'dataWilayah'));
            }

            return view('admin.pelanggan.edit', compact('pelanggan'));
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
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
        try {
            $pelanggan = Pelanggan::find($id);

            $pelanggan->update($request->all());

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Update !'
                ]);
            }

            return redirect()->route('admin.pelanggan.index')
                ->with('success', 'Berhasil Update !');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::find($id);

            $pelanggan->delete();

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
}
