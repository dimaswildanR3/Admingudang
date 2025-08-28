<!-- Modal Edit Stok Cabang -->
<div class="modal fade" id="modal_edit_stok" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Stok Cabang</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="stok_id">
            
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

            <!-- <div class="form-group">
                <label>Stok</label>
                <input type="number" class="form-control" id="edit_stok">
            </div> -->

            <div class="form-group">
                <label>Stok Minimum</label>
                <input type="number" class="form-control" id="edit_stok_minimum">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="button" class="btn btn-primary" id="update">Update</button>
        </div>
      </div>
    </div>
</div>
