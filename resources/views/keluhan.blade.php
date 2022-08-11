@extends('layouts.app', ['title' => 'Keluhan', 'activePage' => 'keluhan'])

@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Keluhan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="@admin {{ route('admin.dashboard') }} @else {{ route('teknisi.dashboard') }} @endadmin">Home</a></li>
          <li class="breadcrumb-item"><a href="#">@admin Admin @else Teknisi @endadmin</a></li>
          <li class="breadcrumb-item active">Keluhan</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row justify-content-center ">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Keluhan</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <table id="keluhan-table" class="table table-striped">
              <thead class="thead-inverse">
                <tr>
                  <th>No</th>
                  <th>Nama Pelanggan</th>
                  <th>Kategori</th>
                  <th>Deskripsi</th>
                  <th>Penyebab</th>
                  <th>Teknisi</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($dataKeluhan as $keluhan)
                  <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $keluhan->nama_pelanggan }}</td>
                    <td>{{ $keluhan->kategori }}</td>
                    <td>{{ $keluhan->deskripsi }}</td>
                    <td>{{ $keluhan->penyebab }}</td>
                    <td>{{ $keluhan->nama }}</td>
                    <td>{{ $keluhan->keterangan }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
  <script>
    $(function() {
      try {
        $("#keluhan-table").DataTable({
          'pageLength': 4,
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#keluhan-table-wrapper');
      } catch (error) {
          console.log(error)
      }
    })
  </script>
@endpush