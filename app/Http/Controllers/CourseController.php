<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // GET all courses
    public function index()
    {
        return response()->json(Course::all(), 200);
    }

    // GET a single course by ID
    public function show($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }
        return response()->json($course, 200);
    }

    // CREATE a new course
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'description' => 'nullable|string|max:45',
            'grade_id' => 'required|exists:grades,id',
        ]);

        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    // UPDATE an existing course
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $request->validate([
            'name' => 'string|max:45',
            'description' => 'nullable|string|max:45',
            'grade_id' => 'exists:grades,id',
        ]);

        $course->update($request->all());
        return response()->json($course, 200);
    }

    // DELETE a course
    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();
        return response()->json(['message' => 'Course deleted'], 200);
    }
}
