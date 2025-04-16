<div class="mb-3">
    <label for="class_code" class="form-label">Class Code</label>
    <input type="text" class="form-control @error('class_code') is-invalid @enderror"
           name="class_code" id="class_code" value="{{ old('class_code', $timetable->class_code ?? '') }}" required>
    @error('class_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="instructor_name" class="form-label">Instructor</label>
    <input type="text" class="form-control @error('instructor_name') is-invalid @enderror"
           name="instructor_name" id="instructor_name" value="{{ old('instructor_name', $timetable->instructor_name ?? '') }}" required>
    @error('instructor_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="room" class="form-label">Room</label>
    <input type="text" class="form-control @error('room') is-invalid @enderror"
           name="room" id="room" value="{{ old('room', $timetable->room ?? '') }}" required>
    @error('room') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="day_of_week" class="form-label">Day of Week</label>
    <select name="day_of_week" id="day_of_week" class="form-select @error('day_of_week') is-invalid @enderror" required>
        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
            <option value="{{ $day }}" {{ old('day_of_week', $timetable->day_of_week ?? '') === $day ? 'selected' : '' }}>
                {{ $day }}
            </option>
        @endforeach
    </select>
    @error('day_of_week') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="start_time" class="form-label">Start Time</label>
    <input type="time" class="form-control @error('start_time') is-invalid @enderror"
           name="start_time" id="start_time" value="{{ old('start_time', $timetable->start_time ?? '') }}" required>
    @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="end_time" class="form-label">End Time</label>
    <input type="time" class="form-control @error('end_time') is-invalid @enderror"
           name="end_time" id="end_time" value="{{ old('end_time', $timetable->end_time ?? '') }}" required>
    @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
