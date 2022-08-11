@extends('layouts.app', ['title' => 'Wilayah', 'activePage' => 'wilayah'])

@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>DataWilayah</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Wilayah</li>
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
            <h3 class="card-title">Data Wilayah</h3>
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
              <button type="button" class="btn btn-primary" onclick="newWilayah()">+ Wilayah</button>
            </div>
            <div id="load-wilayah"></div>
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
      getWilayah()
    })

    async function getWilayah() {
      try {
        var sectionData = $('#load-wilayah')
        url = "{{ route('admin.wilayah.index') }}"
        const response = await HitData(url, null, "GET");
        sectionData.html(response)
        
        $("#wilayah-table").DataTable({
          'pageLength': 4,
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#wilayah-table-wrapper');
      } catch (error) {
          console.log(error)
      }
    }

    async function newWilayah() {
      try {
        var url = "{{ route('admin.wilayah.create') }}"
        var sectionModal = $('.modals')
        sectionModal.html('')
        const response = await HitData(url, null, 'GET');
        var modalResponse = sectionModal.html(response).find('#modalWilayah');

        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function editWilayah(id) {
      try {
        var sectionModal = $('.modals')
        sectionModal.html('')
        url = `/admin/wilayah/${id}/edit`
        const response = await HitData(url, null, 'GET')
        var modalResponse = sectionModal.html(response).find('#modalWilayah')
        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function postCreateOrUpdate(url, type) {
        try {
            event.preventDefault();
            var data = {
                wilayah: $('#wilayah-input').val(),
                status: '1'
            }
            const response = await HitData(url, data, type);

            notif('info', response.message)

            $('#modalWilayah').modal('hide')
            getWilayah()
        } catch (error) {
            console.log(error)
            notif('error', error)
        }
    }

    async function deleteWilayah(id) {
      try {
        var url = `/admin/wilayah/${id}`
        const response = await HitData(url, null, 'DELETE');

        notif('info', response.message)

        getWilayah()
      } catch (error) {
        console.log(error)
        notif('error', error)
      }
    }
  </script>
@endpush