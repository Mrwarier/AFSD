<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Institute - Home</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; color: #333; background: #f5f5f5; }
        nav { background: #2d6a4f; padding: 12px 30px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: bold; font-size: 1rem; }
        nav a:hover { text-decoration: underline; }
        .hero { background: #fff; padding: 60px 30px; text-align: center; }
        .hero h1 { font-size: 2.2rem; color: #1d3557; margin-bottom: 10px; }
        .hero p { font-size: 1.1rem; color: #666; margin-bottom: 30px; }
        .cards { display: flex; gap: 30px; justify-content: center; flex-wrap: wrap; padding: 40px 30px; }
        .card { background: #fff; border-radius: 8px; padding: 30px; width: 260px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; }
        .card h2 { margin-top: 0; }
        .card a { display: inline-block; margin-top: 15px; padding: 10px 20px;
                  border-radius: 4px; text-decoration: none; color: #fff; font-weight: bold; }
        .card-students a { background: #2d6a4f; }
        .card-courses a  { background: #1d3557; }
        .card a:hover { opacity: 0.85; }
    </style>
</head>
<body>

<nav>
    <a href="/">Home</a>
    <a href="/students">Students</a>
    <a href="/courses">Courses</a>
</nav>

<div class="hero">
    <h1>Training Institute</h1>
    <p>Manage students and courses with ease.</p>
</div>

<div class="cards">
    <div class="card card-students">
        <h2>🎓 Students</h2>
        <p>View, add, edit and remove student records.</p>
        <a href="/students">Manage Students</a>
    </div>
    <div class="card card-courses">
        <h2>📚 Courses</h2>
        <p>Manage available courses, fees, and difficulty levels.</p>
        <a href="/courses">Manage Courses</a>
    </div>
</div>

</body>
</html>
