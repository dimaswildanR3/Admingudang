@extends('layouts.app')

@section('content')
<div class="section-header">
  <h1>Edit Surat</h1>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header"><h4>Edit Data Surat</h4></div>
      <div class="card-body">
        <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="jenis">Jenis Surat</label>
            <select name="jenis" id="jenis" class="form-control" required>
              <option value="masuk" {{ $surat->jenis == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
              <option value="keluar" {{ $surat->jenis == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
            </select>
          </div>
          <div class="form-group">
            <label for="perihal">Perihal</label>
            <input type="text" name="perihal" id="perihal" class="form-control" value="{{ $surat->perihal }}" required>
          </div>
          <div class="form-group">
            <label for="tanggal_surat">Tanggal Surat</label>
            <input type="date" name="tanggal_surat" id="tanggal_surat" class="form-control" value="{{ $surat->tanggal_surat }}" required>
          </div>
          <div class="form-group">
            <label for="file">Lampiran (opsional)</label>
            <input type="file" name="file" id="file" class="form-control">
            @if($surat->file)
              <small class="text-muted">File saat ini: <a href="{{ asset('storage/'.$surat->file) }}" target="_blank">Lihat</a></small>
            @endif
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
              <option value="dalam_proses" {{ $surat->status == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
              <option value="diterima" {{ $surat->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
