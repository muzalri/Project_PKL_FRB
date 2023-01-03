@php
  $url = isset($pelanggan) ? "/admin/pelanggan/$pelanggan->id" : "/admin/pelanggan";
  $method = isset($pelanggan) ? 'PUT' : 'POST';
  $title = isset($pelanggan) ? 'Update Pelanggan' : 'Tambah Pelanggan';
  $value = isset($pelanggan) 
    ? [
        'nama' => $pelanggan->nama_pelanggan,
        'no_hp' => $pelanggan->no_hp,
        'alamat' => $pelanggan->alamat,
        'wilayah' => $pelanggan->id_wilayah
      ]
    : [
        'nama' => '',
        'no_hp' => '',
        'alamat' => '',
        'wilayah' => ''
      ];
@endphp

<div class="modal fade" id="modalPelanggan" tabindex="-1" role="dialog" aria-labelledby="modalLabelPelanggan"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelPelanggan">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pelanggan-form" onsubmit="return false;" action="{{ $url }}" method="post">
                    @csrf
                    @method($method)

                    <div class="form-group">
                        <label for="nama-input">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama-input" placeholder="Nama Pelanggan"
                            value="{{ $value['nama'] }}" required>
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
                    <div class="form-group">
                      <label for="wilayah-input" class="form-label">Wilayah</label>
                      <select class="form-control" name="wilayah-input" id="wilayah-input" required>
                        @if(isset($pelanggan))
                          <option value="{{ $pelanggan->id_wilayah }}">{{ $pelanggan->wilayah }}</option>
                        @endif
                        <option value="">Pilih Wilayah</option>
                        @foreach ($dataWilayah as $wilayah)
                          <option value="{{ $wilayah->id }}" @if(isset($pelanggan) && $pelanggan->id_wilayah == $wilayah->id) selected @endif>{{ $wilayah->wilayah }}</option>
                        @endforeach
                      </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button onclick="postCreateOrUpdate('{{ $url }}', '{{ $method }}')" form="pelanggan-form" type="submit"
              class="btn btn-primary btn-block">{{ $title }}</button>
            </div>
        </div>
    </div>
</div>
