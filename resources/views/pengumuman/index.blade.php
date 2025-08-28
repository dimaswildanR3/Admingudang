@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-bullhorn"></i> Pengumuman
                    </h4>
                </div>
                <div class="card-body p-4">
                    <img src="{{ asset('images/gmb.jpeg') }}" 
                         alt="Foto Pengumuman" 
                         class="img-fluid rounded-3 shadow-sm mb-3" 
                         style="transition: transform .3s ease-in-out; cursor: pointer;"
                         onmouseover="this.style.transform='scale(1.03)'"
                         onmouseout="this.style.transform='scale(1)'">
                    
                    <p class="mt-3 text-muted">
                        Berikut adalah informasi terbaru yang perlu diperhatikan. 
                        Silakan cek secara berkala agar tidak ketinggalan update.
                    </p>
                    
                    <a href="/" class="btn btn-outline-primary mt-2">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
