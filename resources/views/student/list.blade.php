<x-layouts.app title="Students">

    <div class="page-header">
        <h1>Students</h1>
        <a href="{{ route('students.create') }}" class="btn btn-success">+ Add Student</a>
    </div>

    @if ($students->isEmpty())
        <div class="alert alert-info">No students found. <a href="{{ route('students.create') }}">Add the first one.</a></div>
    @else
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone ?? '—' }}</td>
                            <td style="display:flex;gap:6px;flex-wrap:wrap;">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                                <x-delete-form :action="route('students.destroy', $student)" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</x-layouts.app>
