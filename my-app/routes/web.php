<?php

/*
|--------------------------------------------------------------------------
| Web Routes – Workshop 1: Students & Courses CRUD
|--------------------------------------------------------------------------
|
| All routes are closures (anonymous functions) as the workshop requires.
| No controllers are used this week.
|
| KEY CONCEPT – Route ordering matters:
|   /students/create must be registered BEFORE /students/{id}.
|   If {id} came first, the string "create" would be captured as an ID
|   and findOrFail('create') would throw a ModelNotFoundException.
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;   // FIX: PDF forgot this import – needed for Rule::unique()->ignore()
use App\Models\Student;
use App\Models\Course;

// ─── Home ────────────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('home');
});

// ═══════════════════════════════════════════════════════════════════════════
//  STUDENT ROUTES
// ═══════════════════════════════════════════════════════════════════════════

/**
 * LIST – GET /students
 *
 * ->name('students.index') gives this route a name so we can redirect to it
 * with route('students.index') without hardcoding the URL.
 * FIX: PDF defined the route but never called ->name(); the POST redirect
 * to route('students.index') would throw an InvalidArgumentException.
 */
Route::get('/students', function () {
    // Student::all() returns every row; for large datasets use paginate()
    $students = Student::all();
    return view('student.list', compact('students'));
})->name('students.index');

/**
 * CREATE FORM – GET /students/create
 * Must come BEFORE the {id} route (see note at top).
 */
Route::get('/students/create', function () {
    return view('student.create');
})->name('students.create');

/**
 * STORE – POST /students
 *
 * KEY CONCEPT – POST vs GET:
 *   GET sends data in the URL (visible, bookmarkable, cacheable).
 *   POST sends data in the request body (hidden, not cached, correct for mutations).
 *
 * KEY CONCEPT – $request->validate():
 *   On failure, Laravel automatically redirects back with errors in the session
 *   and old input, so old() works in the view.
 *   FIX: PDF used $request->input([...]) which skips validation entirely.
 *
 * KEY CONCEPT – @csrf / CSRF token:
 *   Laravel checks a secret token on every POST/PUT/DELETE to ensure the request
 *   really came from your own form, not a malicious third-party site.
 */
Route::post('/students', function (Request $request) {
    $validated = $request->validate([
        'name'          => 'required|string|max:255',
        // FIX: PDF's create route omitted the unique check on email.
        'email'         => 'required|email|max:255|unique:students,email',
        'phone'         => 'required|string|max:20',
        'address'       => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    Student::create($validated);

    /*
     * KEY CONCEPT – Session flashing:
     *   ->with('success', '...') stores the message in the session for ONE request only.
     *   The next page reads it with session('success'), then it disappears automatically.
     *   This is called a "flash message".
     */
    return redirect()->route('students.index')
                     ->with('success', 'Student created successfully!');
})->name('students.store');

/**
 * DETAIL – GET /students/{id}
 *
 * KEY CONCEPT – findOrFail():
 *   findOrFail($id) fetches the row with that primary key.
 *   If no row exists it throws ModelNotFoundException which Laravel converts
 *   to a 404 HTTP response automatically. Using find() instead would return
 *   null and cause a "call to member function on null" error later.
 */
Route::get('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);
    return view('student.detail', compact('student'));
})->name('students.show');

/**
 * EDIT FORM – GET /students/{id}/edit
 */
Route::get('/students/{id}/edit', function ($id) {
    $student = Student::findOrFail($id);
    return view('student.edit', compact('student'));
})->name('students.edit');

/**
 * UPDATE – PUT /students/{id}
 *
 * KEY CONCEPT – Method spoofing (@method):
 *   HTML <form> only supports GET and POST. To send PUT, we POST and include
 *   a hidden field _method=PUT. Laravel reads this and routes accordingly.
 *   @method('PUT') in Blade generates: <input type="hidden" name="_method" value="PUT">
 *
 * Rule::unique('students')->ignore($student->id):
 *   Tells the unique rule to ignore the CURRENT student's own row, so a user
 *   can save without changing their email without getting a "already taken" error.
 *   FIX: The PDF used this but never imported the Rule class (see top of file).
 */
Route::put('/students/{id}', function (Request $request, $id) {
    $student = Student::findOrFail($id);

    $validated = $request->validate([
        'name'          => 'required|string|max:255',
        'email'         => ['required', 'email', 'max:255', Rule::unique('students')->ignore($student->id)],
        'phone'         => 'required|string|max:20',
        'address'       => 'nullable|string|max:500',
        'date_of_birth' => 'nullable|date',
    ]);

    $student->update($validated);

    return redirect()->route('students.index')
                     ->with('success', 'Student updated successfully!');
})->name('students.update');

/**
 * DELETE – DELETE /students/{id}
 */
Route::delete('/students/{id}', function ($id) {
    $student = Student::findOrFail($id);
    $name = $student->name;
    $student->delete();

    return redirect()->route('students.index')
                     ->with('success', "Student '{$name}' deleted successfully.");
})->name('students.destroy');


// ═══════════════════════════════════════════════════════════════════════════
//  COURSE ROUTES  (same CRUD pattern as Students)
// ═══════════════════════════════════════════════════════════════════════════

Route::get('/courses', function () {
    $courses = Course::all();
    return view('course.list', compact('courses'));
})->name('courses.index');

// IMPORTANT: /courses/create BEFORE /courses/{id}
Route::get('/courses/create', function () {
    return view('course.create');
})->name('courses.create');

Route::post('/courses', function (Request $request) {
    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'duration'    => 'required|integer|min:1',
        'fee'         => 'required|numeric|min:0',
        'difficulty'  => 'required|in:Easy,Medium,Hard',
        'is_active'   => 'boolean',
    ]);

    /*
     * KEY CONCEPT – checkbox unchecked state:
     *   Unchecked checkboxes are NOT submitted at all. We use a hidden input
     *   with value="0" before the checkbox so the field is always present.
     *   $request->boolean('is_active') is an alternative: it returns false
     *   for missing, '0', 'false', 'off', 'no'. Either approach works.
     */
    $validated['is_active'] = $request->boolean('is_active');

    Course::create($validated);

    return redirect()->route('courses.index')
                     ->with('success', 'Course created successfully!');
})->name('courses.store');

Route::get('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);
    return view('course.detail', compact('course'));
})->name('courses.show');

Route::get('/courses/{id}/edit', function ($id) {
    $course = Course::findOrFail($id);
    return view('course.edit', compact('course'));
})->name('courses.edit');

Route::put('/courses/{id}', function (Request $request, $id) {
    $course = Course::findOrFail($id);

    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'duration'    => 'required|integer|min:1',
        'fee'         => 'required|numeric|min:0',
        'difficulty'  => 'required|in:Easy,Medium,Hard',
        'is_active'   => 'boolean',
    ]);

    $validated['is_active'] = $request->boolean('is_active');

    $course->update($validated);

    return redirect()->route('courses.index')
                     ->with('success', 'Course updated successfully!');
})->name('courses.update');

Route::delete('/courses/{id}', function ($id) {
    $course = Course::findOrFail($id);
    $name = $course->name;
    $course->delete();

    return redirect()->route('courses.index')
                     ->with('success', "Course '{$name}' deleted successfully.");
})->name('courses.destroy');
