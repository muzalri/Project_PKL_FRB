<table id="pelanggan-table" class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>No HP</th>
      <th class="text-center">Alamat</th>
      <th>Wilayah</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dataPelanggan as $pelanggan)
      <tr>
        <td scope="row">{{ $loop->iteration }}</td>
        <td>{{ $pelanggan->nama_pelanggan }}</td>
        <td>{{ $pelanggan->no_hp }}</td>
        <td>{{ $pelanggan->alamat }}</td>
        <td>{{ $pelanggan->wilayah }}</td>
      </tr>
    @endforeach
  </tbody>
</table>