<table id="keluhan-table" class="table table-striped">
  <thead class="thead-inverse">
    <tr>
      <th>No</th>
      <th>Kategori</th>
      <th>Wilayah</th>
      <th>Kode Pelanggan</th>
      <th>Deskripsi</th>
      <th>Penyebab</th>
      <th>Keterangan</th>
      <th>Teknisi</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($dataKeluhan as $keluhan)
      <tr>
        <td scope="row">{{ $loop->iteration }}</td>
        <td>{{ $keluhan->kategori }}</td>
        <td>{{ $keluhan->wilayah }}</td>
        <td title="{{ $keluhan->nama_pelanggan }}">{{ $keluhan->id_pelanggan }}</td>
        <td>{{ $keluhan->deskripsi }}</td>
        <td>{{ $keluhan->penyebab }}</td>
        <td>
          Status: 
          @if ($keluhan->status == 1)
            Open
          @elseif($keluhan->status == 2)
            On Progress 
          @elseif($keluhan->status == 3)
            Resolve
          @elseif($keluhan->status == 4)
            Closed
          @endif
          <br>
          Keterangan: @if($keluhan->keterangan != null) {{ $keluhan->keterangan }} @else - @endif
        </td>
        <td>
          @foreach ($dataTeknisi as $teknisi)
              @if($teknisi->id == $keluhan->id_teknisi)
                {{ $teknisi->nama }}
              @endif
          @endforeach

          @if($keluhan->id_teknisi == null)
            -
          @endif
        </td>
        <td>
          @admin 
            <form action="{{ route('keluhan.send', $keluhan->id) }}" method="post">
              @csrf
              <input type="text" name="deskripsi" value="{{ $keluhan->deskripsi }}" hidden>
              <input type="text" name="penyebab" value="{{ $keluhan->penyebab }}" hidden>
              <input type="text" name="id_pelanggan" value="{{ $keluhan->id_pelanggan }}" hidden>
              <button type="submit" class="btn btn-sm btn-primary">Send Message</button>
            </form>
          @endadmin
          <button class="btn btn-warning" onclick="editKeluhan('{{ $keluhan->id }}')">Edit</button>
          @admin 
            <button class="btn btn-danger" onclick="return (confirm('Yakin Hapus Data Keluhan ?')) ? deleteKeluhan('{{ $keluhan->id }}') : '' ">Hapus</button>
          @endadmin
        </td>
      </tr>
    @endforeach
  </tbody>
</table>