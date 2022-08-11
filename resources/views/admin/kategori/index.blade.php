@extends('layouts.app', ['title' => 'Kategori', 'activePage' => 'kategori'])

@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Kategori</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Kategori</li>
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
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Kategori</h3>
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
              <button type="button" class="btn btn-primary" onclick="newKategori()">+ Kategori</button>
            </div>
            <div id="load-kategori"></div>
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
      getKategori()
    })

    async function getKategori() {
      try {
        var sectionData = $('#load-kategori')
        url = "{{ route('admin.kategori.index') }}"
        const response = await HitData(url, null, "GET");
        sectionData.html(response)
        
        $("#kategori-table").DataTable({
          'pageLength': 4,
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#kategori-table-wrapper');
      } catch (error) {
          console.log(error)
      }
    }

    async function newKategori() {
      try {
        var url = "{{ route('admin.kategori.create') }}"
        var sectionModal = $('.modals')
        sectionModal.html('')
        const response = await HitData(url, null, 'GET');
        var modalResponse = sectionModal.html(response).find('#modalKategori');

        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function editKategori(id) {
      try {
        var sectionModal = $('.modals')
        sectionModal.html('')
        url = `/admin/kategori/${id}/edit`
        const response = await HitData(url, null, 'GET')
        var modalResponse = sectionModal.html(response).find('#modalKategori')
        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function postCreateOrUpdate(url, type) {
        try {
            event.preventDefault();
            var data = {
                kategori: $('#kategori-input').val(),
                status: '1'
            }
            const response = await HitData(url, data, type);

            notif('info', response.message)

            $('#modalKategori').modal('hide')
            getKategori()
        } catch (error) {
            console.log(error)
            notif('error', error)
        }
    }

    async function deleteKategori(id) {
      try {
        var url = `/admin/kategori/${id}`
        const response = await HitData(url, null, 'DELETE');

        notif('info', response.message)

        getKategori()
      } catch (error) {
        console.log(error)
        notif('error', error)
      }
    }
  </script>
@endpush