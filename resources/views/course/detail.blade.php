<x-layouts.app title="{{ $course->name }}">

    <div class="page-header">
        <h1>{{ $course->name }}</h1>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Edit</a>
            <x-delete-form :action="route('courses.destroy', $course)" />
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">← Back</a>
        </div>
    </div>

    <div class="card">
        <ul class="detail-list">
            <li><strong>ID</strong> {{ $course->id }}</li>
            <li><strong>Name</strong> {{ $course->name }}</li>
            <li><strong>Description</strong> {{ $course->description ?? '—' }}</li>
            <li><strong>Duration</strong> {{ $course->duration }} weeks</li>
            <li><strong>Fee</strong> £{{ number_format($course->fee, 2) }}</li>
            <li><strong>Difficulty</strong> {{ $course->difficulty }}</li>
            <li>
                <strong>Status</strong>
                @if ($course->is_active)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
            </li>
            <li><strong>Created</strong> {{ $course->created_at->format('d M Y') }}</li>
        </ul>
    </div>

</x-layouts.app>
