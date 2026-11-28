<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_api_crud_and_validation(): void
    {
        $listEmpty = $this->getJson('/api/students');
        $listEmpty->assertOk()->assertExactJson(['data' => []]);

        $created = $this->postJson('/api/students', [
            'name' => 'Aarav Sharma',
            'email' => 'aarav@example.com',
            'phone' => '9800000001',
            'address' => 'Kathmandu',
            'date_of_birth' => '2000-05-15',
        ]);

        $created->assertCreated()
            ->assertJsonPath('data.name', 'Aarav Sharma')
            ->assertJsonPath('data.email', 'aarav@example.com')
            ->assertJsonPath('data.date_of_birth', '2000-05-15');

        $studentId = $created->json('data.id');
        $this->assertIsInt($created->json('data.age'));

        $this->postJson('/api/students', [
            'name' => '',
            'email' => 'not-an-email',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'phone']);

        $this->postJson('/api/students', [
            'name' => 'Duplicate Student',
            'email' => 'aarav@example.com',
            'phone' => '9800000002',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['email']);

        $this->getJson('/api/students')
            ->assertOk()
            ->assertJsonCount(1, 'data');

        $this->getJson("/api/students/{$studentId}")
            ->assertOk()
            ->assertJsonPath('data.id', $studentId);

        $this->getJson('/api/students/99999')
            ->assertNotFound();

        $this->putJson("/api/students/{$studentId}", [
            'name' => 'Aarav Updated',
            'email' => 'aarav@example.com',
            'phone' => '9800000099',
            'address' => 'Lalitpur',
            'date_of_birth' => '2000-05-15',
        ])->assertOk()
            ->assertJsonPath('data.name', 'Aarav Updated')
            ->assertJsonPath('data.email', 'aarav@example.com');

        $this->putJson("/api/students/{$studentId}", [
            'name' => 'Aarav Renamed',
            'email' => 'aarav.new@example.com',
            'phone' => '9800000099',
        ])->assertOk()
            ->assertJsonPath('data.email', 'aarav.new@example.com');

        $this->deleteJson("/api/students/{$studentId}")
            ->assertNoContent();

        $this->assertDatabaseMissing('students', ['id' => $studentId]);
    }

    public function test_course_api_crud_and_validation(): void
    {
        $this->getJson('/api/courses')
            ->assertOk()
            ->assertExactJson(['data' => []]);

        $created = $this->postJson('/api/courses', [
            'name' => 'Laravel REST APIs',
            'description' => 'Build REST APIs with Laravel.',
            'duration' => 6,
            'fee' => 299.5,
            'difficulty' => 'Medium',
        ]);

        $created->assertCreated()
            ->assertJsonPath('data.name', 'Laravel REST APIs')
            ->assertJsonPath('data.duration', 6)
            ->assertJsonPath('data.difficulty', 'Medium')
            ->assertJsonPath('data.is_active', true);

        $this->assertSame(299.5, $created->json('data.fee'));

        $courseId = $created->json('data.id');

        $this->postJson('/api/courses', [
            'name' => '',
            'duration' => 0,
            'fee' => -10,
            'difficulty' => 'Expert',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'duration', 'fee', 'difficulty']);

        $this->getJson('/api/courses')
            ->assertOk()
            ->assertJsonCount(1, 'data');

        $this->getJson("/api/courses/{$courseId}")
            ->assertOk()
            ->assertJsonPath('data.id', $courseId);

        $this->getJson('/api/courses/99999')
            ->assertNotFound();

        $this->putJson("/api/courses/{$courseId}", [
            'name' => 'Advanced Laravel APIs',
            'description' => 'Updated description.',
            'duration' => 8,
            'fee' => 350.0,
            'difficulty' => 'Hard',
            'is_active' => false,
        ])->assertOk()
            ->assertJsonPath('data.name', 'Advanced Laravel APIs')
            ->assertJsonPath('data.is_active', false);

        $this->deleteJson("/api/courses/{$courseId}")
            ->assertNoContent();

        $this->assertDatabaseMissing('courses', ['id' => $courseId]);
    }

    public function test_web_app_routes_still_work(): void
    {
        $webStudent = Student::create([
            'name' => 'Web Student',
            'email' => 'webstudent@example.com',
        ]);

        $webCourse = Course::create([
            'name' => 'Web Course',
            'duration' => 4,
            'fee' => 150,
            'difficulty' => 'Easy',
            'is_active' => true,
        ]);

        $this->get('/students')
            ->assertOk()
            ->assertSee('Web Student')
            ->assertSee('href="'.url('/students').'"', false);

        $this->get("/students/{$webStudent->id}")
            ->assertOk()
            ->assertSee('Web Student');

        $this->get('/courses')
            ->assertOk()
            ->assertSee('Web Course')
            ->assertSee('href="'.url('/courses').'"', false);

        $this->get("/courses/{$webCourse->id}")
            ->assertOk()
            ->assertSee('Web Course');

        $this->post('/students', [
            'name' => 'Web Created',
            'email' => 'webcreated@example.com',
        ])->assertRedirect('/students');

        $this->post('/courses', [
            'name' => 'Web Course Created',
            'duration' => 3,
            'fee' => 100,
            'difficulty' => 'Easy',
        ])->assertRedirect('/courses');
    }

    public function test_api_routes_without_accept_header_also_render_json_via_bootstrap_config(): void
    {
        $this->post('/api/students', ['name' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'phone']);

        $this->get('/api/students/99999')
            ->assertNotFound()
            ->assertJsonStructure(['message']);
    }
}
