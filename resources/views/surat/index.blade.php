@extends('layouts.app')

@section('content')
<div class="section-header">
  <h1>Surat {{ ucfirst($jenis ?? 'Tulis') }}</h1>
  <!-- <div class="ml-auto">
    <a href="{{ route('tulis.index') }}" class="btn btn-primary">
      <i class="fa fa-plus"></i> Tulis Surat
    </a>
  </div> -->
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="table_id" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Judul / Perihal</th>
                <th>Pengirim</th>
                <!-- <th>Penerima</th> -->
                <th>Tanggal Surat</th>
                <th>File</th>
                <th>Status</th>
                <th width="150px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($surats as $index => $surat)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->judul }}</td>
                <td>{{ $surat->pengirim }}</td>
                <!-- <td>{{ $surat->penerima }}</td> -->
                <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</td>
                <td>
                  @if($surat->file_surat)
                    <a href="{{ asset('storage/'.$surat->file_surat) }}" target="_blank" class="btn btn-sm btn-info">
                      <i class="fa fa-file"></i> Lihat
                    </a>
                  @else
                    <span class="text-muted">-</span>
                  @endif
                </td>
                <td>
    @if($jenis == 'masuk')
        @if($surat->status == 'draft')
            <span class="badge badge-secondary">{{ ucfirst($surat->status) }}</span>
        @else
            <span class="badge badge-success">Diterima</span>
        @endif
    @else
        @php
            $statusClass = match($surat->status) {
                'dalam_proses' => 'primary',
                'checking' => 'warning',
                'preparing' => 'info',
                'diterima' => 'success',
                default => 'secondary'
            };
        @endphp
        <span class="badge badge-{{ $statusClass }}">{{ ucfirst($surat->status ?? '-') }}</span>
    @endif
</td>

                
                <td>
    {{-- Surat Masuk hanya role_id = 1 --}}
    @if($jenis == 'masuk' && Auth::check() && Auth::user()->role_id == 1)
        @if($surat->status == 'draft')
            <form action="{{ url('/surat/'.$surat->id.'/approve') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui surat ini?')">
                    <i class="fa fa-check"></i> Approve
                </button>
            </form>
            <form action="{{ url('/surat/'.$surat->id.'/reject') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak surat ini?')">
                    <i class="fa fa-times"></i> Reject
                </button>
            </form>
        @else
            <span class="text-muted">-</span>
        @endif
    @endif

    {{-- Surat Keluar: approval berjenjang --}}
    @if($jenis == 'keluar' && Auth::check())
        @if(Auth::user()->role_id == 2 && $surat->status == 'dalam_proses')
            <form action="{{ url('/surat/'.$surat->id.'/approve') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Approve ke Checking</button>
            </form>
        @elseif(Auth::user()->role_id == 3 && $surat->status == 'checking')
            <form action="{{ url('/surat/'.$surat->id.'/approve') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Approve ke Preparing</button>
            </form>
        @elseif(Auth::user()->role_id == 3 && $surat->status == 'preparing')
            <form action="{{ url('/surat/'.$surat->id.'/approve') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Setujui (Diterima)</button>
            </form>
        @else
            <span class="text-muted">-</span>
        @endif
    @endif
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
@endsection
