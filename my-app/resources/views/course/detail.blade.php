<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} - Course Detail</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        nav { background: #1d3557; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        h1 { color: #1d3557; }
        table { border-collapse: collapse; width: 100%; max-width: 600px; }
        th, td { border: 1px solid #ccc; padding: 10px 14px; text-align: left; }
        th { background: #f0f0f0; width: 160px; }
        .btn { display: inline-block; padding: 7px 14px; border-radius: 3px; text-decoration: none; cursor: pointer; border: none; font-size: 0.95rem; margin-right: 8px; }
        .btn-warning { background: #e9c46a; color: #333; }
        .btn-secondary { background: #aaa; color: #fff; }
        .btn-danger { background: #e63946; color: #fff; }
        .btn:hover { opacity: 0.85; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 0.85rem; }
        .badge-active   { background: #d4edda; color: #155724; }
        .badge-inactive { background: #e2e3e5; color: #383d41; }
    </style>
</head>
<body>

<nav>
    <a href="/">Home</a>
    <a href="/students">Students</a>
    <a href="/courses">Courses</a>
</nav>

<h1>Course Detail</h1>

<table>
    <tr><th>ID</th><td>{{ $course->id }}</td></tr>
    <tr><th>Name</th><td>{{ $course->name }}</td></tr>
    <tr><th>Description</th><td>{{ $course->description }}</td></tr>
    <tr><th>Duration</th><td>{{ $course->duration }} week(s)</td></tr>
    <tr><th>Fee</th><td>£{{ number_format($course->fee, 2) }}</td></tr>
    <tr><th>Difficulty</th><td>{{ $course->difficulty }}</td></tr>
    <tr>
        <th>Status</th>
        <td>
            @if ($course->is_active)
                <span class="badge badge-active">Active</span>
            @else
                <span class="badge badge-inactive">Inactive</span>
            @endif
        </td>
    </tr>
    <tr><th>Created</th><td>{{ $course->created_at->format('d M Y, H:i') }}</td></tr>
    <tr><th>Last Updated</th><td>{{ $course->updated_at->format('d M Y, H:i') }}</td></tr>
</table>

<div style="margin-top: 20px;">
    <a href="/courses/{{ $course->id }}/edit" class="btn btn-warning">Edit</a>

    <form action="/courses/{{ $course->id }}" method="POST" style="display:inline;"
          onsubmit="return confirm('Delete this course?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

    <a href="/courses" class="btn btn-secondary">Back to List</a>
</div>

</body>
</html>
