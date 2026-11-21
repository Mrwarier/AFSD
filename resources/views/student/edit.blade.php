<x-layouts.app title="Edit Student">

    <div class="page-header">
        <h1>Edit Student</h1>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card">
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')

            <x-students.form :student="$student" />

            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>

</x-layouts.app>
