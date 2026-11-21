@props(['name', 'label', 'value' => ''])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        class="{{ $errors->has($name) ? 'is-invalid' : '' }}"
        {{ $attributes }}
    >{{ old($name, $value) }}</textarea>
    @error($name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>
