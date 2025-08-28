<div class="modal fade" id="modal_tambah_surat" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Surat Pengajuan</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Cabang</label>
                <select class="form-control" id="cabang_id">
                    @foreach($perusahaans as $cabang)
                        <option value="{{ $cabang->id }}">{{ $cabang->perusahaan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Barang</label>
                <select class="form-control" id="barang_id">
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" id="jumlah" value="1">
            </div>
            <div class="form-group">
    <label>Status</label>
    <select class="form-control" id="status">
        <option value="dalam_proses">Dalam Proses</option>
        <option value="checking">Checking</option>
        <option value="preparing">Preparing</option>
        <option value="dikirim">Dikirim</option>
        <option value="diterima">Diterima</option>
    </select>
</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="button" class="btn btn-primary" id="store">Simpan</button>
        </div>
      </div>
    </div>
</div>
