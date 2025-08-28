<!-- resources/views/surat/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tulis Surat</h2>
    <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label>Nomor Surat</label>
            <input type="text" name="nomor_surat" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Judul Surat</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Tanggal Surat</label>
            <input type="date" name="tanggal_surat" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Isi Surat</label>
            <textarea name="isi" id="editor" class="form-control" rows="10"></textarea>
        </div>

        <div class="form-group mb-3">
            <label>Lampiran</label>
            <input type="file" name="file_surat" class="form-control">
        </div>

        <input type="hidden" name="jenis" value="tulis">

        <button type="submit" class="btn btn-primary">Kirim Surat</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endpush
