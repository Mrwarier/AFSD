<nav class="navbar">
    <a href="{{ route('students.index') }}" class="navbar-brand">🎓 TIMS</a>
    <ul class="navbar-nav">
        <li>
            <a href="{{ route('students.index') }}"
               class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                Students
            </a>
        </li>
        <li>
            <a href="{{ route('courses.index') }}"
               class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">
                Courses
            </a>
        </li>
    </ul>
</nav>
