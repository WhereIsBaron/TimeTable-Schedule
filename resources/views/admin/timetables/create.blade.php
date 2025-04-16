@extends('layouts.app')

@section('title', 'Add Timetable Entry')

@section('content')
    <h1 class="mb-4">➕ Add Timetable Entry</h1>

    <form action="{{ route('timetables.store') }}" method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
        @csrf

        @include('admin.timetables.partials.form', ['timetable' => null])

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('timetables.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
