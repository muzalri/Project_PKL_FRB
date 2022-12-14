@extends('layouts.app', ['title' => 'Pelanggan', 'activePage' => 'pelanggan'])

@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Pelanggan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Pelanggan</li>
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
            <h3 class="card-title">Data Pelanggan</h3>
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
            <div id="load-pelanggan"></div>
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
      getPelanggan()
    })

    async function getPelanggan() {
      try {
        var sectionData = $('#load-pelanggan')
        url = "{{ route('admin.pelanggan.index') }}"
        const response = await HitData(url, null, "GET");
        sectionData.html(response)
        
        $("#pelanggan-table").DataTable({
          'pageLength': 4,
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#pelanggan-table-wrapper');
      } catch (error) {
          console.log(error)
      }
    }
    async function newPelanggan() {
      try {
        var url = "{{ route('admin.pelanggan.create') }}"
        var sectionModal = $('.modals')
        sectionModal.html('')
        const response = await HitData(url, null, 'GET');
        var modalResponse = sectionModal.html(response).find('#modalPelanggan');

        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function editPelanggan(id) {
      try {
        var sectionModal = $('.modals')
        sectionModal.html('')
        url = `/admin/pelanggan/${id}/edit`
        const response = await HitData(url, null, 'GET')
        var modalResponse = sectionModal.html(response).find('#modalPelanggan')
        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function postCreateOrUpdate(url, type) {
        try {
            event.preventDefault();
            var data = {
                nama_pelanggan: $('#nama-input').val(),
                no_hp: $('#no_hp-input').val(),
                alamat: $('#alamat-input').val(),
                id_wilayah: $('#wilayah-input').val(),
                status: '1'
            }
            const response = await HitData(url, data, type);

            notif('info', response.message)

            $('#modalPelanggan').modal('hide')
            getPelanggan()
        } catch (error) {
            console.log(error)
            notif('error', error)
        }
    }

    async function deletePelanggan(id) {
      try {
        var url = `/admin/pelanggan/${id}`
        const response = await HitData(url, null, 'DELETE');

        notif('info', response.message)

        getPelanggan()
      } catch (error) {
        console.log(error)
        notif('error', error)
      }
    }
  </script>
@endpush