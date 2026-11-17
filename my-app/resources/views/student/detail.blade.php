<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $student->name }} - Student Detail</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        nav { background: #2d6a4f; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        h1 { color: #2d6a4f; }
        table { border-collapse: collapse; width: 100%; max-width: 600px; }
        th, td { border: 1px solid #ccc; padding: 10px 14px; text-align: left; }
        th { background: #f0f0f0; width: 160px; }
        .btn { display: inline-block; padding: 7px 14px; border-radius: 3px; text-decoration: none; cursor: pointer; border: none; font-size: 0.95rem; margin-right: 8px; }
        .btn-warning { background: #e9c46a; color: #333; }
        .btn-secondary { background: #aaa; color: #fff; }
        .btn-danger { background: #e63946; color: #fff; }
        .btn:hover { opacity: 0.85; }
    </style>
</head>
<body>

<nav>
    <a href="/">Home</a>
    <a href="/students">Students</a>
    <a href="/courses">Courses</a>
</nav>

<h1>Student Detail</h1>

<table>
    <tr><th>ID</th><td>{{ $student->id }}</td></tr>
    <tr><th>Name</th><td>{{ $student->name }}</td></tr>
    <tr><th>Email</th><td>{{ $student->email }}</td></tr>
    <tr><th>Phone</th><td>{{ $student->phone }}</td></tr>
    <tr><th>Address</th><td>{{ $student->address ?? '—' }}</td></tr>
    <tr><th>Date of Birth</th><td>{{ $student->date_of_birth ?? '—' }}</td></tr>
    <tr><th>Created</th><td>{{ $student->created_at->format('d M Y, H:i') }}</td></tr>
    <tr><th>Last Updated</th><td>{{ $student->updated_at->format('d M Y, H:i') }}</td></tr>
</table>

<div style="margin-top: 20px;">
    <a href="/students/{{ $student->id }}/edit" class="btn btn-warning">Edit</a>

    <form action="/students/{{ $student->id }}" method="POST" style="display:inline;"
          onsubmit="return confirm('Delete this student?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <a href="/students" class="btn btn-secondary">Back to List</a>
</div>

</body>
</html>
