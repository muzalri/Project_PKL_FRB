@php
  $url = isset($wilayah) ? "/admin/wilayah/$wilayah->id" : "/admin/wilayah";
  $method = isset($wilayah) ? 'PUT' : 'POST';
  $title = isset($wilayah) ? 'Update Wilayah' : 'Tambah Wilayah';
  $value = isset($wilayah) ? $wilayah->wilayah : '';
@endphp

<div class="modal fade" id="modalWilayah" tabindex="-1" role="dialog" aria-labelledby="modalLabelWilayah"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelWilayah">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="wilayah-form" onsubmit="return false;" action="{{ $url }}" method="post">
                    @csrf
                    @method($method)

                    <div class="form-group">
                        <label for="wilayah-input">Wilayah</label>
                        <input type="text" class="form-control" id="wilayah-input" placeholder="Nama wilayah"
                            value="{{ $value }}" required>
                        <div class="invalid-feedback d-block"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button onclick="postCreateOrUpdate('{{ $url }}', '{{ $method }}')" form="wilayah-form" type="button"
              class="btn btn-primary btn-block">{{ $title }}</button>
            </div>
        </div>
    </div>
</div>
