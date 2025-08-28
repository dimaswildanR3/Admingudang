<!-- Modal View Stok Cabang -->
<div class="modal fade" id="modal_view_stok" tabindex="-1" role="dialog" aria-labelledby="modalViewStokLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stok Cabang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="stokCabangTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Stok</th>
                            <th>Stok Minimum</th>
                        </tr>
                    </thead>
                    <tbody id="stokCabangBody">
                        <!-- Data stok akan diisi via AJAX -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
