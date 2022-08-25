<table id="pelanggan-table" class="table table-striped">
  <thead class="thead-inverse">
    <div class="text-right mb-3">
      <button type="button" class="btn btn-primary" onclick="newPelanggan()">+ Pelanggan</button>
    </div>
    <tr>
      <th>No</th>
      <th>Kode Pelanggan</th>
      <th>Nama</th>
      <th>No HP</th>
      <th class="text-center">Alamat</th>
      <th>Wilayah</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dataPelanggan as $pelanggan)
      <tr>
        <td scope="row">{{ $loop->iteration }}</td>
        <td>{{ $pelanggan->id }}</td>
        <td>{{ $pelanggan->nama_pelanggan }}</td>
        <td>{{ $pelanggan->no_hp }}</td>
        <td>{{ $pelanggan->alamat }}</td>
        <td>{{ $pelanggan->wilayah }}</td>
        <td class="text-center">
          <button class="btn btn-warning" onclick="editPelanggan('{{ $pelanggan->id }}')">Edit</button>
          <button class="btn btn-danger" onclick="return (confirm('Yakin Hapus Data Pelanggan {{ $pelanggan->nama }}')) ? deletePelanggan('{{ $pelanggan->id }}') : '' ">Hapus</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>