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
            <div class="text-right mb-3">
              <button type="button" class="btn btn-primary" onclick="newKeluhan()">+ Keluhan</button>
            </div>
            <div id="load-keluhan"></div>
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
      getKeluhan()
    });

    async function getKeluhan() {
      try {
        var sectionData = $('#load-keluhan')
        url = "{{ route('keluhan.load') }}"
        const response = await HitData(url, null, "GET");
        sectionData.html(response)

        $("#keluhan-table").DataTable({
          'pageLength': 4,
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#keluhan-table-wrapper');
      } catch (error) {
          console.log(error)
      }
    }
    
    async function newKeluhan() {
      try {
        var url = "{{ route('keluhan.create') }}"
        var sectionModal = $('.modals')
        sectionModal.html('')
        const response = await HitData(url, null, 'GET');
        var modalResponse = sectionModal.html(response).find('#modalKeluhan');

        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function editKeluhan(id) {
      try {
        var sectionModal = $('.modals')
        sectionModal.html('')
        url = `/keluhan/${id}/edit`
        const response = await HitData(url, null, 'GET')
        var modalResponse = sectionModal.html(response).find('#modalKeluhan')
        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function postCreateOrUpdate(url, type) {
        try {
            event.preventDefault();
            if (type == 'POST') {
              var data = {
                id_pelanggan: $('#pelanggan-input').val(),
                id_kategori: $('#kategori-input').val(),
                deskripsi: $('#deskripsi-input').val(),
                penyebab: $('#penyebab-input').val(),
                status: '1'
              }
            } else if (type == 'PUT') {
              var data = {
                id_pelanggan: $('#pelanggan-input').val(),
                id_kategori: $('#kategori-input').val(),
                deskripsi: $('#deskripsi-input').val(),
                penyebab: $('#penyebab-input').val(),
                keterangan: $('#keterangan-input').val(),
                status: $('#status-input').val(),
              }
            }
            const response = await HitData(url, data, type);

            notif('info', response.message)

            $('#modalKeluhan').modal('hide')
            getKeluhan()
        } catch (error) {
            console.log(error)
            notif('error', error)
        }
    }

    async function deleteKeluhan(id) {
      try {
        var url = `/keluhan/${id}`
        const response = await HitData(url, null, 'DELETE');

        notif('info', response.message)

        getKeluhan()
      } catch (error) {
        console.log(error)
        notif('error', error)
      }
    }
  </script>
@endpush

