<div class="modal fade" id="modal_edit_surat" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Surat Pengajuan</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="surat_id">

            <div class="form-group">
                <label>Cabang</label>
                <select class="form-control" id="edit_cabang_id">
                    @foreach($perusahaans as $cabang)
                        <option value="{{ $cabang->id }}">{{ $cabang->perusahaan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Barang</label>
                <select class="form-control" id="edit_barang_id">
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" id="edit_jumlah">
            </div>

            <div class="form-group">
    <label>Status</label>
    <select class="form-control" id="edit_status">
        <option value="dalam_proses">Dalam Proses  (1)</option>
        <option value="checking">Checking (2)</option>
        <option value="preparing">Preparing (3)</option>
        <option value="diterima">Diterima</option>
    </select>
</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="button" class="btn btn-primary" id="update">Update</button>
        </div>
      </div>
    </div>
</div>
