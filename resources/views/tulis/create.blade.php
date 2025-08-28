@extends('layouts.app')

@section('content')
<div class="section-header">
  <h1>Tulis Surat</h1>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header"><h4>Form Surat Baru</h4></div>
      <div class="card-body">
        <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="jenis">Jenis Surat</label>
            <select name="jenis" id="jenis" class="form-control" required>
              <option value="">-- Pilih Jenis --</option>
              <option value="masuk">Surat Masuk</option>
              <option value="keluar">Surat Keluar</option>
            </select>
          </div>
          <div class="form-group">
            <label for="perihal">Perihal</label>
            <input type="text" name="perihal" id="perihal" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tanggal_surat">Tanggal Surat</label>
            <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="file">Lampiran (opsional)</label>
            <input type="file" name="file" id="file" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
