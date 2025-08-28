@extends('layouts.app')

@include('perusahaan.create')
@include('perusahaan.edit')

@section('content')
<div class="section-header">
    <h1>Data Cabang</h1>
    <div class="ml-auto">
        <a href="javascript:void(0)" class="btn btn-primary" id="button_tambah_perusahaan">
            <i class="fa fa-plus"></i> Cabang
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

<script>
$(document).ready(function() {
    $('#table_id').DataTable();

    // Show modal tambah
    $('#button_tambah_perusahaan').click(function() {
        $('#modal_tambah_perusahaan').modal('show');
    });

    // Store data via AJAX
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
            error: function(err) {
                console.log(err);
            }
        });
    });

    // Update via AJAX
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

    // Hapus data via event delegation
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
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
        });
    });
});

// Fungsi editPerusahaan di global scope agar onclick di HTML bisa memanggilnya
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
        error: function(err) {
            console.log(err);
        }
    });
}
</script>
@endsection
