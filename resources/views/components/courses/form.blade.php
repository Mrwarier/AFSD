@props(['course'])

{{-- Name --}}
<x-form-input
    name="name"
    label="Course Name"
    :value="$course->name ?? ''"
    placeholder="e.g. Web Development Fundamentals"
    required
/>

{{-- Description --}}
<x-form-textarea
    name="description"
    label="Description"
    :value="$course->description ?? ''"
    placeholder="Brief overview of the course..."
/>

{{-- Duration --}}
<x-form-input
    name="duration"
    label="Duration (weeks)"
    type="number"
    :value="$course->duration ?? ''"
    min="1"
    placeholder="e.g. 12"
    required
/>

{{-- Fee --}}
<x-form-input
    name="fee"
    label="Fee (£)"
    type="number"
    :value="$course->fee ?? ''"
    min="0"
    step="0.01"
    placeholder="e.g. 499.99"
    required
/>

{{-- Difficulty --}}
<div class="form-group">
    <label for="difficulty">Difficulty</label>
    <select
        id="difficulty"
        name="difficulty"
        class="{{ $errors->has('difficulty') ? 'is-invalid' : '' }}"
        required
    >
        <option value="">-- Select difficulty --</option>
        @foreach (['Easy', 'Medium', 'Hard'] as $level)
            <option value="{{ $level }}" @selected(old('difficulty', $course->difficulty ?? '') === $level)>
                {{ $level }}
            </option>
        @endforeach
    </select>
    @error('difficulty')
        <span class="error">{{ $message }}</span>
    @enderror
</div>

{{-- Active status: hidden 0 + checkbox pattern so unchecked still posts false --}}
<input type="hidden" name="is_active" value="0">
<div class="checkbox-group">
    <input
        type="checkbox"
        id="is_active"
        name="is_active"
        value="1"
        @checked((bool) old('is_active', $course->is_active ?? true))
    >
    <label for="is_active">Active (visible to students)</label>
</div>
@error('is_active')
    <span class="error">{{ $message }}</span>
@enderror
