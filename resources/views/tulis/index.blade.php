@extends('layouts.app')

@section('content')
<div class="section-header">
  <h1>Tulis Surat</h1>
  <div class="ml-auto">
    <a href="{{ route('surat.index') }}" class="btn btn-secondary">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('tulis.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="nomor_surat">Nomor Surat</label>
            <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}" required>
            @error('nomor_surat')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="judul">Judul / Perihal</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
            @error('judul')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="isi">Isi Surat</label>
            <textarea name="isi" id="isi" class="form-control" rows="8" required>{{ old('isi') }}</textarea>
            @error('isi')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <!-- <div class="form-group">
            <label for="tanggal_surat">Tanggal Surat</label>
            <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" value="{{ old('tanggal_surat') }}" required>
            @error('tanggal_surat')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div> -->

          <div class="form-group">
            <label for="file_surat">File Surat (opsional)</label>
            <input type="file" name="file_surat" id="file_surat" class="form-control">
            @error('file_surat')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group d-none">
  <label for="jenis">Jenis Surat</label>
  <select name="jenis" id="jenis" class="form-control">
    <option value="masuk" selected>Masuk</option>
  </select>
</div>


          <button type="submit" class="btn btn-primary">
            <i class="fa fa-paper-plane"></i> Kirim Surat
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
