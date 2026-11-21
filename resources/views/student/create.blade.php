<x-layouts.app title="Add Student">

    <div class="page-header">
        <h1>Add Student</h1>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <x-students.form :student="$student" />

            <button type="submit" class="btn btn-success">Save Student</button>
        </form>
    </div>

</x-layouts.app>
