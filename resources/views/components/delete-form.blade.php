@props(['action'])

<form action="{{ $action }}" method="POST" class="inline-form">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        class="btn btn-danger btn-sm"
        onclick="return confirm('Are you sure you want to delete this record?')"
    >
        Delete
    </button>
</form>
