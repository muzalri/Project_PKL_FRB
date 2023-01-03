@php
  $url = isset($keluhan) ? "/keluhan/$keluhan->id" : "/keluhan";
  $method = isset($keluhan) ? 'PUT' : 'POST';
  $title = isset($keluhan) ? 'Update Keluhan' : 'Tambah Keluhan';
  $value = isset($keluhan) 
    ? [
        'id_kategori' => $keluhan->id_kategori,
        'id_pelanggan' => $keluhan->id_pelanggan,
        'deskripsi' => $keluhan->deskripsi,
        'penyebab' => $keluhan->penyebab,
        'keterangan' => $keluhan->keterangan,
        'status' => $keluhan->status
      ]
    : [
        'id_kategori' => '',
        'id_pelanggan' => '',
        'deskripsi' => '',
        'penyebab' => '',
        'keterangan' => '',
        'status' => ''
      ];
@endphp

<div class="modal fade" id="modalKeluhan" tabindex="-1" role="dialog" aria-labelledby="modalLabelKeluhan"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelKeluhan">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="keluhan-form" onsubmit="return false;" action="{{ $url }}" method="post">
                    @csrf
                    @method($method)

                    @admin 
                    <div class="form-group">
                      <label for="kategori-input" class="form-label">Kategori</label>
                      <select class="form-control" name="kategori-input" id="kategori-input" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($dataKategori as $kategori)
                          <option value="{{ $kategori->id }}" @if(isset($keluhan) && $keluhan->id_kategori == $kategori->id) selected @endif>{{ $kategori->kategori }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pelanggan-input" class="form-label">Pelanggan</label>
                      <select class="form-control" name="pelanggan-input" id="pelanggan-input" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach ($dataPelanggan as $pelanggan)
                          <option value="{{ $pelanggan->id }}" @if(isset($keluhan) && $keluhan->id_pelanggan == $pelanggan->id) selected @endif>{{ $pelanggan->nama_pelanggan }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi-input">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi-input" placeholder="Deskripsi"
                            value="{{ $value['deskripsi'] }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                        <label for="penyebab-input">Penyebab</label>
                        <input type="text" class="form-control" id="penyebab-input" placeholder="Penyebab"
                            value="{{ $value['penyebab'] }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                    @endadmin
                    <div class="form-group">
                      <label for="keterangan-input">Keterangan</label>
                      <input type="text" class="form-control" id="keterangan-input" placeholder="Keterangan"
                          value="{{ $value['keterangan'] }}" required>
                      <div class="invalid-feedback d-block"></div>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control select2" id="status-input" name="status" style="width: 100%">
                        <option>Pilih Status</option>
                          <option value="1" @if ('1' == $keluhan->status) selected="selected" @endif>Open</option>
                          <option value="2" @if ('2' == $keluhan->status) selected="selected" @endif>On Progress</option>
                          <option value="3" @if ('3' == $keluhan->status) selected="selected" @endif>Resolve</option>
                          <option value="4" @if ('4' == $keluhan->status) selected="selected" @endif>Closed</option>
                      </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button onclick="postCreateOrUpdate('{{ $url }}', '{{ $method }}')" form="keluhan-form" type="submit"
              class="btn btn-primary btn-block">{{ $title }}</button>
            </div>
        </div>
    </div>
</div>
