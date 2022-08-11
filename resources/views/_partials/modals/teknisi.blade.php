@php
  $url = isset($teknisi) ? "/admin/teknisi/$teknisi->id" : "/admin/teknisi";
  $method = isset($teknisi) ? 'PUT' : 'POST';
  $title = isset($teknisi) ? 'Update Teknisi' : 'Tambah Teknisi';
  $value = isset($teknisi) 
    ? [
        'nama' => $teknisi->nama,
        'jabatan' => $teknisi->jabatan,
        'nik' => $teknisi->nik,
        'no_hp' => $teknisi->no_hp,
        'alamat' => $teknisi->alamat,
      ]
    : [
        'nama' => '',
        'jabatan' => '',
        'nik' => '',
        'no_hp' => '',
        'alamat' => '',
      ];
@endphp

<div class="modal fade" id="modalTeknisi" tabindex="-1" role="dialog" aria-labelledby="modalLabelTeknisi"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelTeknisi">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="teknisi-form" onsubmit="return false;" action="{{ $url }}" method="post">
                    @csrf
                    @method($method)

                    <div class="form-group">
                        <label for="nama-input">Nama Teknisi</label>
                        <input type="text" class="form-control" id="nama-input" placeholder="Nama Teknisi"
                            value="{{ $value['nama'] }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan-input">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan-input" placeholder="Jabatan"
                            value="{{ $value['jabatan'] }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                        <label for="nik-input">NIK</label>
                        <input type="text" class="form-control" id="nik-input" placeholder="NIK"
                            value="{{ $value['nik'] }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                        <label for="no_hp-input">No Handphone</label>
                        <input type="text" class="form-control" id="no_hp-input" placeholder="No Handphone"
                            value="{{ $value['no_hp'] }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                        <label for="alamat-input">Alamat</label>
                        <input type="text" class="form-control" id="alamat-input" placeholder="Alamat"
                            value="{{ $value['alamat'] }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button onclick="postCreateOrUpdate('{{ $url }}', '{{ $method }}')" form="teknisi-form" type="button"
              class="btn btn-primary btn-block">{{ $title }}</button>
            </div>
        </div>
    </div>
</div>
