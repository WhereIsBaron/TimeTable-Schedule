@extends('layouts.app')

@section('title', 'Master Timetables')

@section('content')
    <h1 class="mb-4">📘 Master Timetables</h1>

    <a href="{{ route('admin.master_timetables.create') }}" class="btn btn-success mb-3">➕ Add Master Timetable</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Assigned Faculty Admins</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($masterTimetables as $timetable)
                        <tr>
                            <td>{{ $timetable->name }}</td>
                            <td>{{ $timetable->description }}</td>
                            <td>{{ $timetable->facultyAdmins->count() }}</td>
                            <td>
                                <a href="{{ route('admin.master-timetables.edit', $timetable->id) }}" class="btn btn-sm btn-primary">✏️ Edit</a>
                                <form action="{{ route('admin.master-timetables.destroy', $timetable->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this master timetable?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">No Master Timetables found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection