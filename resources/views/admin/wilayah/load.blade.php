<table id="wilayah-table" class="table table-striped text-center
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
        }">
  <thead class="thead-inverse">
    <tr>
      <th>No</th>
      <th>Nama Wilayah</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dataWilayah as $wilayah)
      <tr>
        <td scope="row">{{ $loop->iteration }}</td>
        <td>{{ $wilayah->wilayah }}</td>
        <td>
          <button class="btn btn-warning" onclick="editWilayah('{{ $wilayah->id }}')">Edit</button>
          <button class="btn btn-danger" onclick="return (confirm('Yakin Hapus Data Wilayah {{ $wilayah->wilayah }}')) ? deleteWilayah('{{ $wilayah->id }}') : '' ">Hapus</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>