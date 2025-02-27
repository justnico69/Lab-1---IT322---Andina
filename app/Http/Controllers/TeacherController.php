<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index() { return response()->json(Teacher::all(), 200); }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) return response()->json(['message' => 'Teacher not found'], 404);
        return response()->json($teacher, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|string|max:45',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'status' => 'boolean'
        ]);

        return response()->json(Teacher::create($request->all()), 201);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) return response()->json(['message' => 'Teacher not found'], 404);

        $teacher->update($request->all());
        return response()->json($teacher, 200);
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) return response()->json(['message' => 'Teacher not found'], 404);

        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted'], 200);
    }
}
