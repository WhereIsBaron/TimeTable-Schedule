@extends('layouts.app')

@section('title', 'Add Room')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>➕ Add Room</h1>
        <div>
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary btn-sm">⬅️ Back</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm">🏠 Dashboard</a>
        </div>
    </div>

    <form action="{{ route('admin.rooms.store') }}" method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
        @csrf
        @include('admin.rooms.partials.form')
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
