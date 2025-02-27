<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index() { return response()->json(Student::all(), 200); }

    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);
        return response()->json($student, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|max:45',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'mobile' => 'nullable|string|max:15',
            'status' => 'boolean'
        ]);

        return response()->json(Student::create($request->all()), 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);

        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);

        $student->delete();
        return response()->json(['message' => 'Student deleted'], 200);
    }
}
