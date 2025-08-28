@extends('layouts.app')

@include('surat_pengajuan.create') <!-- modal tambah -->
@include('surat_pengajuan.edit')   <!-- modal edit -->

@section('content')
<div class="section-header">
    <h1>Data Surat Pengajuan</h1>
    <div class="ml-auto">
        <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_surat">
            <i class="fa fa-plus"></i> Tambah Surat
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Cabang</th>
                                <th>Perihal</th>
                                <th>Tanggal Surat</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suratPengajuans as $index => $surat)
                                <tr id="row_{{ $surat->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $surat->cabang->perusahaan }}</td>
                                    <td>Permohonan <br> permintaan <br> kertas polis <br></td>
                                    <td>tanggal surat (28-08-2024)</td>
                                    <td>{{ $surat->barang->nama_barang }}</td>
                                    <td>
    @switch($surat->status)
        @case('dalam_proses')
            <span class="badge badge-primary border border-dark px-2 py-1">Dalam Proses</span>
            @break
        @case('checking')
            <span class="badge badge-warning border border-dark px-2 py-1">Checking</span>
            @break
        @case('preparing')
            <span class="badge badge-info border border-dark px-2 py-1">Preparing</span>
            @break
        @case('dikirim')
            <span class="badge badge-secondary border border-dark px-2 py-1">Dikirim</span>
            @break
        @case('diterima')
            <span class="badge badge-success border border-dark px-2 py-1">Diterima</span>
            @break
        @default
            <span class="badge badge-light border border-dark px-2 py-1">{{ $surat->status }}</span>
    @endswitch
</td>

                                    <td>
                                        <button class="btn btn-warning btn-lg mb-2" onclick="editSurat({{ $surat->id }})">aproval
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <!-- <button class="btn btn-danger btn-lg mb-2 btn-delete" data-id="{{ $surat->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button> -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#table_id').DataTable();

    // Show modal tambah
    $('#button_tambah_surat').click(function() {
        $('#modal_tambah_surat').modal('show');
    });

    // Store via AJAX
    $('#store').click(function(e) {
        e.preventDefault();
        let cabang_id = $('#cabang_id').val();
        let barang_id = $('#barang_id').val();
        let jumlah = $('#jumlah').val();
        let status = $('#status').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: '/surat-pengajuan',
            type: 'POST',
            data: { cabang_id, barang_id, jumlah, status, _token: token },
            success: function(response) {
                Swal.fire('Sukses', response.message, 'success');
                $('#modal_tambah_surat').modal('hide');
                location.reload();
            },
            error: function(err) { console.log(err); }
        });
    });

    // Update via AJAX
    $('#update').click(function(e) {
        e.preventDefault();
        let id = $('#surat_id').val();
        let cabang_id = $('#edit_cabang_id').val();
        let barang_id = $('#edit_barang_id').val();
        let jumlah = $('#edit_jumlah').val();
        let status = $('#edit_status').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/surat-pengajuan/${id}`,
            type: 'POST',
            data: { cabang_id, barang_id, jumlah, status, _token: token, _method: 'PUT' },
            success: function(response) {
                Swal.fire('Sukses', response.message, 'success');
                $('#modal_edit_surat').modal('hide');
                location.reload();
            },
            error: function(err) { console.log(err); }
        });
    });

    // Hapus via SweetAlert
    $(document).on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        let token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/surat-pengajuan/${id}`,
                    type: 'POST',
                    data: { _method: 'DELETE', _token: token },
                    success: function(response) {
                        Swal.fire('Sukses', response.message, 'success');
                        $('#row_' + id).fadeOut(500, function() { $(this).remove(); });
                    },
                    error: function(err) { console.log(err); }
                });
            }
        });
    });
});

// Edit surat function
function editSurat(id) {
    $.ajax({
        url: `/surat-pengajuan/${id}/edit`,
        type: 'GET',
        success: function(response) {
            $('#surat_id').val(response.data.id);
            $('#edit_cabang_id').val(response.data.cabang_id);
            $('#edit_barang_id').val(response.data.barang_id);
            $('#edit_jumlah').val(response.data.jumlah);
            $('#edit_status').val(response.data.status);
            $('#modal_edit_surat').modal('show');
        },
        error: function(err) { console.log(err); }
    });
}
</script>
@endsection
