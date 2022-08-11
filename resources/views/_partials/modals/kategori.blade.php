@php
  $url = isset($kategori) ? "/admin/kategori/$kategori->id" : "/admin/kategori";
  $method = isset($kategori) ? 'PUT' : 'POST';
  $title = isset($kategori) ? 'Update Kategori' : 'Tambah Kategori';
  $value = isset($kategori) ? $kategori->kategori : '';
@endphp

<div class="modal fade" id="modalKategori" tabindex="-1" role="dialog" aria-labelledby="modalLabelKategori"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelKategori">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="kategori-form" onsubmit="return false;" action="{{ $url }}" method="post">
                    @csrf
                    @method($method)

                    <div class="form-group">
                        <label for="kategori-input">Kategori</label>
                        <input type="text" class="form-control" id="kategori-input" placeholder="Nama Kategori"
                            value="{{ $value }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button onclick="postCreateOrUpdate('{{ $url }}', '{{ $method }}')" form="kategori-form" type="button"
              class="btn btn-primary btn-block">{{ $title }}</button>
            </div>
        </div>
    </div>
</div>
