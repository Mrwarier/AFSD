<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $student->name }} - Training Institute</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        nav { background: #2d6a4f; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        h1 { color: #2d6a4f; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input[type="text"], input[type="email"], input[type="date"], textarea {
            width: 100%; max-width: 450px; padding: 7px; border: 1px solid #ccc;
            border-radius: 4px; box-sizing: border-box;
        }
        .btn { display: inline-block; padding: 8px 16px; border-radius: 3px; text-decoration: none; cursor: pointer; border: none; font-size: 1rem; }
        .btn-primary { background: #2d6a4f; color: #fff; }
        .btn-secondary { background: #aaa; color: #fff; }
        .btn:hover { opacity: 0.85; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; max-width: 470px; }
        .field-error { color: #e63946; font-size: 0.85rem; margin-top: 3px; }
    </style>
</head>
<body>

<nav>
    <a href="/">Home</a>
    <a href="/students">Students</a>
    <a href="/courses">Courses</a>
</nav>

<h1>Edit Student: {{ $student->name }}</h1>

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

{{-- HTML forms only support GET and POST. To send a PUT request,
     we POST to the same URL and include a hidden _method=PUT field.
     @method('PUT') generates that hidden field automatically. --}}
<form action="/students/{{ $student->id }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Full Name <span style="color:red">*</span></label>
        {{-- old('name', $student->name): use submitted value if validation failed,
             otherwise fall back to the existing database value --}}
        <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" required>
        @error('name') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="email">Email Address <span style="color:red">*</span></label>
        <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}" required>
        @error('email') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="phone">Phone Number <span style="color:red">*</span></label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone) }}" required>
        @error('phone') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <textarea id="address" name="address" rows="3" style="max-width:450px; width:100%;">{{ old('address', $student->address) }}</textarea>
        @error('address') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="date_of_birth">Date of Birth</label>
        <input type="date" id="date_of_birth" name="date_of_birth"
               value="{{ old('date_of_birth', $student->date_of_birth) }}">
        @error('date_of_birth') <span class="field-error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group" style="margin-top:20px;">
        <button type="submit" class="btn btn-primary">Update Student</button>
        <a href="/students/{{ $student->id }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

</body>
</html>
