<!-- Timetable edit blade placeholder -->@extends('layouts.app')

@section('title', 'Edit Timetable Entry')

@section('content')
    <h1 class="mb-4">✏️ Edit Timetable Entry</h1>

    <form action="{{ route('timetables.update', $timetable->id) }}" method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
        @csrf
        @method('PUT')

        @include('admin.timetables.partials.form', ['timetable' => $timetable])

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('timetables.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
