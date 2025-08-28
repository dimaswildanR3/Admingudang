@extends('layouts.app')

@include('perusahaan.create') <!-- modal tambah cabang -->
@include('perusahaan.edit')   <!-- modal edit cabang -->
@include('stok_cabang.view')   <!-- modal view stok -->

@section('content')
<div class="section-header">
    <h1>Data Cabang</h1>
    <div class="ml-auto">
        <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_perusahaan">
            <i class="fa fa-plus"></i> Tambah Cabang
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
                                <th>Nama Kantor Cabang</th>
                                <th>Alamat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perusahaans as $index => $perusahaan)
                                <tr id="row_{{ $perusahaan->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $perusahaan->perusahaan }}</td>
                                    <td>{{ $perusahaan->alamat }}</td>
                                    <td>
                                        <button class="btn btn-info btn-lg mb-2" onclick="viewStok({{ $perusahaan->id }})">
                                            <i class="fas fa-eye"></i> Stok
                                        </button>
                                        <button class="btn btn-warning btn-lg mb-2" onclick="editPerusahaan({{ $perusahaan->id }})">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-lg mb-2 btn-delete" data-id="{{ $perusahaan->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

<!-- Script AJAX -->
<script>
$(document).ready(function() {
    $('#table_id').DataTable();

    // Show modal tambah perusahaan
    $('#button_tambah_perusahaan').click(function() {
        $('#modal_tambah_perusahaan').modal('show');
    });

    // Store perusahaan
    $('#store').click(function(e) {
        e.preventDefault();
        let perusahaan = $('#perusahaan').val();
        let alamat = $('#alamat').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: '/perusahaan',
            type: 'POST',
            data: { perusahaan, alamat, _token: token },
            success: function(response) {
                Swal.fire('Sukses', response.message, 'success');
                $('#modal_tambah_perusahaan').modal('hide');
                location.reload();
            },
            error: function(err) { console.log(err); }
        });
    });

    // Update perusahaan
    $('#update').click(function(e) {
        e.preventDefault();
        let id = $('#perusahaan_id').val();
        let perusahaan = $('#edit_perusahaan').val();
        let alamat = $('#edit_alamat').val();
        let token = $("meta[name='csrf-token']").attr("content");

        $.ajax({
            url: `/perusahaan/${id}`,
            type: 'POST',
            data: { perusahaan, alamat, _token: token, _method: 'PUT' },
            success: function(response) {
                Swal.fire('Sukses', response.message, 'success');
                $('#modal_edit_perusahaan').modal('hide');
                location.reload();
            }
        });
    });

    // Hapus perusahaan
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
                    url: `/perusahaan/${id}`,
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

// Edit perusahaan
function editPerusahaan(id) {
    $.ajax({
        url: `/perusahaan/${id}/edit`,
        type: 'GET',
        success: function(response) {
            $('#perusahaan_id').val(response.data.id);
            $('#edit_perusahaan').val(response.data.perusahaan);
            $('#edit_alamat').val(response.data.alamat);
            $('#modal_edit_perusahaan').modal('show');
        },
        error: function(err) { console.log(err); }
    });
}

// View stok per cabang
function viewStok(cabang_id) {
    $.ajax({
        url: `/stok-cabang/view/${cabang_id}`,
        type: 'GET',
        success: function(response) {
            let tbody = '';
            response.data.forEach((stok, index) => {
                tbody += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${stok.barang.nama_barang}</td>
                        <td>${stok.stok}</td>
                        <td>${stok.stok_minimum}</td>
                    </tr>
                `;
            });
            $('#stokCabangBody').html(tbody);

            if ($.fn.DataTable.isDataTable('#stokCabangTable')) {
                $('#stokCabangTable').DataTable().destroy();
            }

            $('#stokCabangTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthChange: false,
                info: false
            });

            $('#modal_view_stok').modal('show');
        },
        error: function(err) {
            console.log(err);
            Swal.fire('Error', 'Gagal mengambil data stok cabang', 'error');
        }
    });
}
</script>
@endsection
