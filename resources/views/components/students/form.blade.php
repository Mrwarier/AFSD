@props(['student'])

{{-- Name --}}
<x-form-input
    name="name"
    label="Full Name"
    :value="$student->name ?? ''"
    placeholder="e.g. Jane Smith"
    required
/>

{{-- Email --}}
<x-form-input
    name="email"
    label="Email Address"
    type="email"
    :value="$student->email ?? ''"
    placeholder="e.g. jane@example.com"
    required
/>

{{-- Phone --}}
<x-form-input
    name="phone"
    label="Phone Number"
    :value="$student->phone ?? ''"
    placeholder="e.g. +44 7700 900000"
/>

{{-- Date of Birth --}}
<x-form-input
    name="date_of_birth"
    label="Date of Birth"
    type="date"
    :value="$student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : ''"
/>

{{-- Address --}}
<x-form-textarea
    name="address"
    label="Address"
    :value="$student->address ?? ''"
    placeholder="e.g. 123 High Street, London"
/>
