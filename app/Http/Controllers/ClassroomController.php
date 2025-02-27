<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function index() { return response()->json(Classroom::all(), 200); }

    public function show($id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) return response()->json(['message' => 'Classroom not found'], 404);
        return response()->json($classroom, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|integer',
            'section' => 'required|string|max:2',
            'status' => 'boolean',
            'class_name' => 'nullable|string|max:45',
            'teacher_id' => 'required|exists:teachers,id'
        ]);

        return response()->json(Classroom::create($request->all()), 201);
    }

    public function update(Request $request, $id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) return response()->json(['message' => 'Classroom not found'], 404);

        $classroom->update($request->all());
        return response()->json($classroom, 200);
    }

    public function destroy($id)
    {
        $classroom = Classroom::find($id);
        if (!$classroom) return response()->json(['message' => 'Classroom not found'], 404);

        $classroom->delete();
        return response()->json(['message' => 'Classroom deleted'], 200);
    }
}
