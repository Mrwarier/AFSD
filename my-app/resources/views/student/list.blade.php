<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Training Institute</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        nav { background: #2d6a4f; padding: 10px 20px; border-radius: 5px; margin-bottom: 20px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        h1 { color: #2d6a4f; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #2d6a4f; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
        .btn { display: inline-block; padding: 5px 12px; border-radius: 3px; text-decoration: none; font-size: 0.85rem; cursor: pointer; border: none; }
        .btn-primary { background: #2d6a4f; color: #fff; }
        .btn-info    { background: #457b9d; color: #fff; }
        .btn-warning { background: #e9c46a; color: #333; }
        .btn-danger  { background: #e63946; color: #fff; }
        .btn:hover   { opacity: 0.85; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .alert-error   { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>

<nav>
    <a href="/">Home</a>
    <a href="/students">Students</a>
    <a href="/courses">Courses</a>
</nav>

<h1>All Students</h1>

{{-- session('success') is a one-time flash value stored in the session.
     After it is read once it is removed automatically. --}}
@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

<a href="/students/create" class="btn btn-primary" style="margin-bottom:15px;">+ Add New Student</a>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        {{-- @forelse is like @foreach but has a built-in @empty block when the collection is empty --}}
        @forelse ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->date_of_birth ?? '—' }}</td>
                <td>
                    <a href="/students/{{ $student->id }}" class="btn btn-info">View</a>
                    <a href="/students/{{ $student->id }}/edit" class="btn btn-warning">Edit</a>

                    {{-- DELETE uses a small inline form because HTML only supports GET and POST.
                         @method('DELETE') adds a hidden _method field that Laravel reads to
                         route the request to the DELETE handler. --}}
                    <form action="/students/{{ $student->id }}" method="POST" style="display:inline;"
                          onsubmit="return confirm('Delete {{ $student->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#999;">No students found. <a href="/students/create">Add one!</a></td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
