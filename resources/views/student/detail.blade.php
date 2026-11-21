<x-layouts.app title="{{ $student->name }}">

    <div class="page-header">
        <h1>{{ $student->name }}</h1>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Edit</a>
            <x-delete-form :action="route('students.destroy', $student)" />
            <a href="{{ route('students.index') }}" class="btn btn-secondary">← Back</a>
        </div>
    </div>

    <div class="card">
        <ul class="detail-list">
            <li><strong>ID</strong> {{ $student->id }}</li>
            <li><strong>Name</strong> {{ $student->name }}</li>
            <li><strong>Email</strong> {{ $student->email }}</li>
            <li><strong>Phone</strong> {{ $student->phone ?? '—' }}</li>
            <li>
                <strong>Date of Birth</strong>
                {{ $student->date_of_birth ? $student->date_of_birth->format('d M Y') : '—' }}
                @if ($student->age !== null)
                    <span style="color:#888;">({{ $student->age }} years old)</span>
                @endif
            </li>
            <li><strong>Address</strong> {{ $student->address ?? '—' }}</li>
            <li><strong>Registered</strong> {{ $student->created_at->format('d M Y') }}</li>
        </ul>
    </div>

</x-layouts.app>
