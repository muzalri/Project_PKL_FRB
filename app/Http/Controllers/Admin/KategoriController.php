<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $dataKategori = Kategori::all();

            if (request()->ajax()) {
                return view('admin.kategori.load', compact('dataKategori'));
            }

            return view('admin.kategori.index', compact('dataKategori'));
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
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
            if (request()->ajax()) {
                return view('_partials.modals.kategori');
            }

            return view('admin.kategori.create');
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
            Kategori::create($request->all());

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menyimpan !'
                ]);
            }

            return redirect()->route('admin.kategori.index')
                ->with('success', 'Berhasil Menyimpan !');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
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
            $kategori = Kategori::find($id);

            if (request()->ajax()) {
                return view('_partials.modals.kategori', compact('kategori'));
            }

            return view('admin.kategori.edit', $kategori);
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
            $kategori = Kategori::find($id);

            $kategori->update($request->all());

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Update !'
                ]);
            }

            return redirect()->route('admin.kategori.index')
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
            $kategori = Kategori::find($id);

            $kategori->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Hapus !'
                ]);
            }

            return redirect()->route('admin.kategori.index')->with('success', 'Berhasil Hapus !');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
