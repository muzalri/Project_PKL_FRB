<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $dataWilayah = Wilayah::all();

            if (request()->ajax()) {
                return view('admin.wilayah.load', compact('dataWilayah'));
            }

            return view('admin.wilayah.index', compact('dataWilayah'));
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
                return view('_partials.modals.wilayah');
            }

            return view('admin.wilayah.create');
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
            Wilayah::create($request->all());
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menyimpan !'
                ]);
            }

            return redirect()->route('admin.wilayah.index')
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
            $wilayah = Wilayah::find($id);

            if (request()->ajax()) {
                return view('_partials.modals.wilayah', compact('wilayah'));
            }

            return view('admin.wilayah.edit', compact('wilayah'));
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
            $wilayah = Wilayah::find($id);

            $wilayah->update($request->all());

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Update !'
                ]);
            }

            return redirect()->route('admin.wilayah.index')
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
            $wilayah = Wilayah::find($id);

            $wilayah->delete(); 

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Hapus !',
                ]);
            }

            return redirect()->route('admin.kategori.index')
                ->with('success', 'Berhasil Hapus !');
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }
}
