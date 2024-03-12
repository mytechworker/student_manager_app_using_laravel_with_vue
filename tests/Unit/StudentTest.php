<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\factory;
use App\Models\Student;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testCreateStudent()
    {
        // Create a student using the factory
        $studentFactoryData = [
            'username' => "factory_user",
            'email' => "factory_user@example.com",
        ];
        $factoryStudent = Student::factory()->create($studentFactoryData);

        // Data for creating a new student via API
        $apiStudentData = [
            'username' => "api_user",
            'email' => "api_user@example.com",
        ];

        // Send request to create a student using the provided data
        $response = $this->actingAs($factoryStudent, 'api')->json('POST', '/api/students', $apiStudentData);

        // Assert the status and JSON response
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "Student Created Successfully!!"]);
        $response->assertJson(['student' => $apiStudentData]);
        
        // Optional: Check if the student was actually created in the database
        $this->assertDatabaseHas('students', $apiStudentData);
    }

    public function testGettingAllStudents()
    {
        $student = Student::factory()->create();
        $response = $this->json('GET', '/api/students');
        $response->assertJsonFragment([
            'username' => $student->username,
            'email' => $student->email,
            // Add any other fields you expect to be present in the JSON response
        ]);
    }

    public function testDeleteStudent()
    {
        // Create a new student using the factory
        $student = Student::factory()->create([
            'username' => 'John Doe',
            'email' => 'john@example.com',
            // Assign other attributes here
        ]);

        // Send request to delete the student
        $response = $this->actingAs($student, 'api')->json('DELETE', '/api/students/' . $student->id);

        // Assert the status and message
        $response->assertStatus(200);
        $response->assertJson(['message' => "Student Deleted Successfully!!"]);
    }
}
