<table id="user-table" class="table table-striped text-center">
  <thead class="thead-inverse">
    <tr>
      <th>No</th>
      <th>Kode Teknisi</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Password</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dataUser as $user)
      <tr>
        <td scope="row">{{ $loop->iteration }}</td>
        <td>
          @if ($user->role == '1') 
            {{ $user->id_teknisi }}
          @else
            -
          @endif
        </td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->pwd }}</td>
        <td>
          <button class="btn btn-warning" onclick="editUser('{{ $user->id }}')">Edit</button>
          <button class="btn btn-danger" onclick="return (confirm('Yakin Hapus Data user {{ $user->email }}')) ? deleteUser('{{ $user->id }}') : '' ">Hapus</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>