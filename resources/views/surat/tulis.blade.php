@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tulis Surat</h2>
    <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Judul Surat -->
        <div class="form-group mb-3">
            <label for="judul">Judul Surat</label>
            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul surat" required>
        </div>

        <!-- Penerima -->
        <div class="form-group mb-3">
            <label for="penerima">Penerima</label>
            <input type="text" name="penerima" class="form-control" placeholder="Kepada siapa surat ini ditujukan" required>
        </div>

        <!-- Isi Surat (Editor) -->
        <div class="form-group mb-3">
            <label for="isi">Isi Surat</label>
            <textarea name="isi" id="editor" rows="10" class="form-control"></textarea>
        </div>

        <!-- Lampiran -->
        <div class="form-group mb-3">
            <label for="lampiran">Lampiran (opsional)</label>
            <input type="file" name="lampiran" class="form-control">
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary">Kirim Surat</button>
    </form>
</div>
@endsection

@push('scripts')
<!-- CKEditor / TinyMCE -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endpush
