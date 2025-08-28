@extends('layouts.app')

@section('content')
<div class="section">
    <h1>Notifikasi</h1>
    <div class="list-group">
        @foreach($notifications as $notification)
        <a href="{{ route('notification.read', $notification->id) }}" 
           class="list-group-item list-group-item-action {{ $notification->is_read ? '' : 'list-group-item-primary' }}">
            <strong>{{ $notification->title }}</strong><br>
            {{ $notification->message }}
            <small class="text-muted float-right">{{ $notification->created_at->diffForHumans() }}</small>
        </a>
        @endforeach
    </div>
    {{ $notifications->links() }}
</div>
@endsection
