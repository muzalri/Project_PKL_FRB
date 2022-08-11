@extends('layouts.app', ['title' => 'Teknisi', 'activePage' => 'teknisi'])

@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Teknisi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Teknisi</li>
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
            <h3 class="card-title">Data Teknisi</h3>
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
              <button type="button" class="btn btn-primary" onclick="newTeknisi()">+ Teknisi</button>
            </div>
            <div id="load-teknisi"></div>
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
      getTeknisi()
    })

    async function getTeknisi() {
      try {
        var sectionData = $('#load-teknisi')
        url = "{{ route('admin.teknisi.index') }}"
        const response = await HitData(url, null, "GET");
        sectionData.html(response)
        
        $("#teknisi-table").DataTable({
          'pageLength': 4,
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#teknisi-table-wrapper');
      } catch (error) {
          console.log(error)
      }
    }

    async function newTeknisi() {
      try {
        var url = "{{ route('admin.teknisi.create') }}"
        var sectionModal = $('.modals')
        sectionModal.html('')
        const response = await HitData(url, null, 'GET');
        var modalResponse = sectionModal.html(response).find('#modalTeknisi');

        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function editTeknisi(id) {
      try {
        var sectionModal = $('.modals')
        sectionModal.html('')
        url = `/admin/teknisi/${id}/edit`
        const response = await HitData(url, null, 'GET')
        var modalResponse = sectionModal.html(response).find('#modalTeknisi')
        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function postCreateOrUpdate(url, type) {
        try {
            event.preventDefault();
            var data = {
                nama: $('#nama-input').val(),
                jabatan: $('#jabatan-input').val(),
                nik: $('#nik-input').val(),
                no_hp: $('#no_hp-input').val(),
                alamat: $('#alamat-input').val(),
                status: '1',
            }
            const response = await HitData(url, data, type);

            notif('info', response.message)

            $('#modalTeknisi').modal('hide')
            getTeknisi()
        } catch (error) {
            console.log(error)
            notif('error', error)
        }
    }

    async function deleteTeknisi(id) {
      try {
        var url = `/admin/teknisi/${id}`
        const response = await HitData(url, null, 'DELETE');

        notif('info', response.message)

        getTeknisi()
      } catch (error) {
        console.log(error)
        notif('error', error)
      }
    }
</script>
@endpush