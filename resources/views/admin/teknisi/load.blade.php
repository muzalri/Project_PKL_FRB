<table id="teknisi-table" class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>No</th>
      <th>Kode Teknisi</th>
      <th>Nama</th>
      <th>Jabatan</th>
      <th>NIK</th>
      <th>No HP</th>
      <th style="width: 25%">Alamat</th>
      <th class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dataTeknisi as $teknisi)
      <tr>
        <td scope="row">{{ $loop->iteration }}</td>
        <td>{{ $teknisi->id }}</td>
        <td>{{ $teknisi->nama }}</td>
        <td>{{ $teknisi->jabatan }}</td>
        <td>{{ $teknisi->nik }}</td>
        <td>{{ $teknisi->no_hp }}</td>
        <td>{{ $teknisi->alamat }}</td>
        <td class="text-center">
          <button class="btn btn-warning" onclick="editTeknisi('{{ $teknisi->id }}')">Edit</button>
          <button class="btn btn-danger" onclick="return (confirm('Yakin Hapus Data Teknisi {{ $teknisi->nama }}')) ? deleteTeknisi('{{ $teknisi->id }}') : '' ">Hapus</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>