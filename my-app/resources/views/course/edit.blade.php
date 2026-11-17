<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $course->name }} - Training Institute</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        nav { background: #1d3557; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        h1 { color: #1d3557; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input[type="text"], input[type="number"], select, textarea {
            width: 100%; max-width: 450px; padding: 7px; border: 1px solid #ccc;
            border-radius: 4px; box-sizing: border-box;
        }
        .btn { display: inline-block; padding: 8px 16px; border-radius: 3px; text-decoration: none; cursor: pointer; border: none; font-size: 1rem; }
        .btn-primary { background: #1d3557; color: #fff; }
        .btn-secondary { background: #aaa; color: #fff; }
        .btn:hover { opacity: 0.85; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; max-width: 470px; }
        .field-error { color: #e63946; font-size: 0.85rem; margin-top: 3px; }
        .checkbox-group { display: flex; align-items: center; gap: 8px; }
    </style>
</head>
<body>

<nav>
    <a href="/">Home</a>
    <a href="/students">Students</a>
    <a href="/courses">Courses</a>
</nav>

<h1>Edit Course: {{ $course->name }}</h1>

@if ($errors->any())
    <div class="alert-error">
        <strong>Please fix the following errors:</strong>
        <ul style="margin:5px 0 0 15px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/courses/{{ $course->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Course Name <span style="color:red">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $course->name) }}" required>
        @error('name') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="description">Description <span style="color:red">*</span></label>
        <textarea id="description" name="description" rows="4" style="max-width:450px; width:100%;">{{ old('description', $course->description) }}</textarea>
        @error('description') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="duration">Duration (weeks) <span style="color:red">*</span></label>
        <input type="number" id="duration" name="duration" min="1"
               value="{{ old('duration', $course->duration) }}" required>
        @error('duration') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="fee">Fee (£) <span style="color:red">*</span></label>
        <input type="number" id="fee" name="fee" min="0" step="0.01"
               value="{{ old('fee', $course->fee) }}" required>
        @error('fee') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="difficulty">Difficulty <span style="color:red">*</span></label>
        <select id="difficulty" name="difficulty" required>
            <option value="">-- Select Difficulty --</option>
            @foreach (['Easy', 'Medium', 'Hard'] as $level)
                <option value="{{ $level }}"
                    {{ old('difficulty', $course->difficulty) == $level ? 'selected' : '' }}>
                    {{ $level }}
                </option>
            @endforeach
        </select>
        @error('difficulty') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        {{-- Same hidden-before-checkbox trick as the create form --}}
        <input type="hidden" name="is_active" value="0">
        <div class="checkbox-group">
            <input type="checkbox" id="is_active" name="is_active" value="1"
                   {{ old('is_active', $course->is_active) ? 'checked' : '' }}>
            <label for="is_active" style="display:inline; font-weight:normal;">Course is Active</label>
        </div>
        @error('is_active') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group" style="margin-top:20px;">
        <button type="submit" class="btn btn-primary">Update Course</button>
        <a href="/courses/{{ $course->id }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

</body>
</html>
