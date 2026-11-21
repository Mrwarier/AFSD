<x-layouts.app title="Courses">

    <div class="page-header">
        <h1>Courses</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-success">+ Add Course</a>
    </div>

    @if ($courses->isEmpty())
        <div class="alert alert-info">No courses found. <a href="{{ route('courses.create') }}">Add the first one.</a></div>
    @else
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Fee</th>
                        <th>Difficulty</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->duration }} weeks</td>
                            <td>£{{ number_format($course->fee, 2) }}</td>
                            <td>{{ $course->difficulty }}</td>
                            <td>
                                @if ($course->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td style="display:flex;gap:6px;flex-wrap:wrap;">
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">Edit</a>
                                <x-delete-form :action="route('courses.destroy', $course)" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</x-layouts.app>
