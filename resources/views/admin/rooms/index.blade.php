@extends('layouts.app')

@section('title', 'Rooms')

@section('styles')
    <style>
        .dark-mode .table td,
        .dark-mode .table th {
            color: #e0e0e0;
        }

        .back-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
    <div class="back-links">
        <h1>🏫 Room Management</h1>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm">🏠 Dashboard</a>
        </div>
    </div>

    <a href="{{ route('admin.rooms.create') }}" class="btn btn-success mb-3">➕ Add Room</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Available</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->type }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>{{ $room->is_available ? '✅' : '❌' }}</td>
                            <td>{{ $room->description }}</td>
                            <td>
                                <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No rooms found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
