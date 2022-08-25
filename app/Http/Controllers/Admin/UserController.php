<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Teknisi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $dataUser = User::where('role', '1')->get();

            if (request()->ajax()) {
                return view('admin.user.load', compact('dataUser'));
            }

            return view('admin.user.index', compact('dataUser'));
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
            if (request()->ajax()) {
                return view('_partials.modals.user');
            }

            return view('admin.user.create');
        } catch (\Throwable $th) {
            throw $th;
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
            $random = now()->format('ym') . rand(10000000, 99999999);

            Teknisi::create([
                'id' => $random,
                'nama' => $request->input('nama'),
                'nik' => $request->input('nik'),
                'no_hp' => $request->input('no_hp'),
                'alamat' => $request->input('alamat'),
                'jabatan' => $request->input('jabatan'),
                'status' => 1,
            ]);

            User::create([
                'name' => $request->input('nama'),
                'email' => $request->input('email'),
                'pwd' => $request->input('password'),
                'password' => bcrypt($request->input('password')),
                'role' => '1',
                'id_teknisi' => $random,
            ]);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                'message' => 'Berhasil Menyimpan !'
                ]);
            }

            return redirect()->route('admin.user.index')
                            ->with('success', 'Berhasil Menyimpan !');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {
            if (request()->ajax()) {
                return view('_partials.modals.user', compact('user'));
            }

            return view('admin.kategori.edit', compact('user'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            $user->update([
                'email' => $request->email,
                'pwd' => $request->password,
                'password' => bcrypt($request->password),
            ]);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Update !'
                ]);
            }

            return redirect()->route('admin.user.index')
                ->with('success', 'Berhasil Update !');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Hapus !'
                ]);
            }

            return redirect()->route('admin.user.index')->with('success', 'Berhasil Hapus !');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
