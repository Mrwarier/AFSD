<x-layouts.app title="Add Course">

    <div class="page-header">
        <h1>Add Course</h1>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card">
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf

            <x-courses.form :course="$course" />

            <button type="submit" class="btn btn-success">Save Course</button>
        </form>
    </div>

</x-layouts.app>
