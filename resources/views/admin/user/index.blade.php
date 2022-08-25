@extends('layouts.app', ['title' => 'User', 'activePage' => 'user'])

@section('breadcrumb')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">User</li>
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
            <h3 class="card-title">Data User</h3>
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
              <button type="button" class="btn btn-primary" onclick="newUser()">+ User</button>
            </div>
            <div id="load-user"></div>
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
      getUser()
    })

    async function getUser() {
      try {
        var sectionData = $('#load-user')
        url = "{{ route('admin.user.index') }}"
        const response = await HitData(url, null, "GET");
        sectionData.html(response)
        
        $("#user-table").DataTable({
          'pageLength': 4,
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#user-table-wrapper');
      } catch (error) {
          console.log(error)
      }
    }

    async function newUser() {
      try {
        var url = "{{ route('admin.user.create') }}"
        var sectionModal = $('.modals')
        sectionModal.html('')
        const response = await HitData(url, null, 'GET');
        var modalResponse = sectionModal.html(response).find('#modalUser');

        modalResponse.modal('show')
      } catch (error) {
        console.log(error)
      }
    }

    async function editUser(id) {
      try {
        var sectionModal = $('.modals')
        sectionModal.html('')
        url = `/admin/user/${id}/edit`
        const response = await HitData(url, null, 'GET')
        var modalResponse = sectionModal.html(response).find('#modalUser')
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
                email: $('#email-input').val(),
                password: $('#password-input').val(),
                nama: $('#nama-input').val(),
                nik: $('#nik-input').val(),
                no_hp: $('#no_hp-input').val(),
                jabatan: $('#jabatan-input').val(),
                alamat: $('#alamat-input').val(),
              }
            } else if (type == 'PUT') {
              var data = {
                email: $('#email-input').val(),
                password: $('#password-input').val()
              }
            }
            const response = await HitData(url, data, type);
            
            notif('info', response.message)

            $('#modalUser').modal('hide')
            getUser()
        } catch (error) {
            console.log(error)
            notif('error', error)
        }
    }

    async function deleteUser(id) {
      try {
        var url = `/admin/user/${id}`
        const response = await HitData(url, null, 'DELETE');

        notif('info', response.message)

        getUser()
      } catch (error) {
        console.log(error)
        notif('error', error)
      }
    }
  </script>
@endpush