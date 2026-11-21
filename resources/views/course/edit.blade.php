<x-layouts.app title="Edit Course">

    <div class="page-header">
        <h1>Edit Course</h1>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card">
        <form action="{{ route('courses.update', $course) }}" method="POST">
            @csrf
            @method('PUT')

            <x-courses.form :course="$course" />

            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>

</x-layouts.app>
