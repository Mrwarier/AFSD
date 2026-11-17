<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - Training Institute</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        nav { background: #1d3557; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        h1 { color: #1d3557; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #1d3557; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 0.8rem; }
        .badge-easy   { background: #d4edda; color: #155724; }
        .badge-medium { background: #fff3cd; color: #856404; }
        .badge-hard   { background: #f8d7da; color: #721c24; }
        .badge-active   { background: #d4edda; color: #155724; }
        .badge-inactive { background: #e2e3e5; color: #383d41; }
        .btn { display: inline-block; padding: 5px 12px; border-radius: 3px; text-decoration: none; font-size: 0.85rem; cursor: pointer; border: none; }
        .btn-primary { background: #1d3557; color: #fff; }
        .btn-info    { background: #457b9d; color: #fff; }
        .btn-warning { background: #e9c46a; color: #333; }
        .btn-danger  { background: #e63946; color: #fff; }
        .btn:hover   { opacity: 0.85; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>

<nav>
    <a href="/">Home</a>
    <a href="/students">Students</a>
    <a href="/courses">Courses</a>
</nav>

<h1>All Courses</h1>

@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<a href="/courses/create" class="btn btn-primary" style="margin-bottom:15px;">+ Add New Course</a>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Duration (weeks)</th>
            <th>Fee (£)</th>
            <th>Difficulty</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->duration }}</td>
                <td>{{ number_format($course->fee, 2) }}</td>
                <td>
                    <span class="badge badge-{{ strtolower($course->difficulty) }}">
                        {{ $course->difficulty }}
                    </span>
                </td>
                <td>
                    @if ($course->is_active)
                        <span class="badge badge-active">Active</span>
                    @else
                        <span class="badge badge-inactive">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="/courses/{{ $course->id }}" class="btn btn-info">View</a>
                    <a href="/courses/{{ $course->id }}/edit" class="btn btn-warning">Edit</a>
                    <form action="/courses/{{ $course->id }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Delete {{ $course->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align:center; color:#999;">No courses yet. <a href="/courses/create">Add one!</a></td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
