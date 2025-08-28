<div class="modal fade" id="modal_tambah_stok" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Stok Cabang</h5>
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
                <label>Stok</label>
                <input type="number" class="form-control" id="stok" value="0">
            </div>
            <div class="form-group">
                <label>Stok Minimum</label>
                <input type="number" class="form-control" id="stok_minimum" value="0">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="button" class="btn btn-primary" id="store">Simpan</button>
        </div>
      </div>
    </div>
</div>
