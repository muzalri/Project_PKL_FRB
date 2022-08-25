@php
  $url = isset($user) ? "/admin/user/$user->id" : "/admin/user";
  $method = isset($user) ? 'PUT' : 'POST';
  $title = isset($user) ? 'Update User' : 'Tambah User';
  $value = isset($user) 
    ? [
      'email' => $user->email,
      'password' => $user->pwd
    ]
    : [
      'email' => '',
      'password' => ''
    ];
@endphp

<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalLabelUser"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelUser">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="user-form" onsubmit="return false;" action="{{ $url }}" method="post">
                    @csrf
                    @method($method)

                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" value="{{ $value['email'] }}" class="form-control" id="email-input" placeholder="Email" required/>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="text" name="password" value="{{ $value['password'] }}" class="form-control" id="password-input" placeholder="Password" required/>
                    </div>
                    <hr>
                    @if ($method == 'POST')
                    <div class="form-group">
                      <label>Nama Teknisi</label>
                      <input type="text" name="nama" class="form-control" id="nama-input" placeholder="Nama Teknisi" required/>
                    </div>
                    <div class="form-group">
                      <label>NIK</label>
                      <input type="number" name="nik" class="form-control" id="nik-input" placeholder="NIK" required/>
                    </div>
                    <div class="form-group">
                      <label>No HP</label>
                      <input type="number" name="no_hp" class="form-control" id="no_hp-input" placeholder="No HP" required/>
                    </div>
                    <div class="form-group">
                      <label>Jabatan</label>
                      <select class="form-control select2" id="jabatan-input" name="jabatan" style="width: 100%" required>
                        <option value="" selected="selected">Pilih Jabatan</option>
                          <option value="1">Teknisi</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" name="alamat" class="form-control" id="alamat-input" placeholder="Alamat" required/>
                    </div>
                    @endif
                </form>
            </div>
            <div class="modal-footer">
              <button onclick="postCreateOrUpdate('{{ $url }}', '{{ $method }}')" form="user-form" type="button"
              class="btn btn-primary btn-block">{{ $title }}</button>
            </div>
        </div>
    </div>
</div>
