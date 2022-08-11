<table id="kategori-table" class="table table-striped text-center">
  <thead class="thead-inverse">
    <tr>
      <th>No</th>
      <th>Kategori</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dataKategori as $kategori)
      <tr>
        <td scope="row">{{ $loop->iteration }}</td>
        <td>{{ $kategori->kategori }}</td>
        <td>
          <button class="btn btn-warning" onclick="editKategori('{{ $kategori->id }}')">Edit</button>
          <button class="btn btn-danger" onclick="return (confirm('Yakin Hapus Data Kategori {{ $kategori->kategori }}')) ? deleteKategori('{{ $kategori->id }}') : '' ">Hapus</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>