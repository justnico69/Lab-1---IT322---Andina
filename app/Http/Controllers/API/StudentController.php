<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('parent')->get();
        
        return response()->json([
            'success' => true,
            'data' => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:students',
            'password' => 'required|min:6',
            'fname' => 'required|string|max:45',
            'lname' => 'required|string|max:45',
            'dob' => 'required|date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'required|string|max:15',
            'parent_id' => 'required|exists:parents,parent_id',
            'date_of_join' => 'required|date',
            'status' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $student = new Student();
        $student->email = $request->email;
        $student->password = $request->password; // In a real app, use Hash::make()
        $student->fname = $request->fname;
        $student->lname = $request->lname;
        $student->dob = $request->dob;
        $student->phone = $request->phone;
        $student->mobile = $request->mobile;
        $student->parent_id = $request->parent_id;
        $student->date_of_join = $request->date_of_join;
        $student->status = $request->status;
        $student->save();

        return response()->json([
            'success' => true,
            'data' => $student,
            'message' => 'Student created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::with(['parent', 'classrooms'])->find($id);
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'email' => 'email|unique:students,email,' . $id . ',student_id',
            'password' => 'min:6',
            'fname' => 'string|max:45',
            'lname' => 'string|max:45',
            'dob' => 'date',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'string|max:15',
            'parent_id' => 'exists:parents,parent_id',
            'date_of_join' => 'date',
            'status' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Update only the provided fields
        if ($request->has('email')) $student->email = $request->email;
        if ($request->has('password')) $student->password = $request->password; // In a real app, use Hash::make()
        if ($request->has('fname')) $student->fname = $request->fname;
        if ($request->has('lname')) $student->lname = $request->lname;
        if ($request->has('dob')) $student->dob = $request->dob;
        if ($request->has('phone')) $student->phone = $request->phone;
        if ($request->has('mobile')) $student->mobile = $request->mobile;
        if ($request->has('parent_id')) $student->parent_id = $request->parent_id;
        if ($request->has('date_of_join')) $student->date_of_join = $request->date_of_join;
        if ($request->has('status')) $student->status = $request->status;
        
        $student->save();
        
        return response()->json([
            'success' => true,
            'data' => $student,
            'message' => 'Student updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }
        
        $student->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully'
        ]);
    }
    
    /**
     * Get attendances for a specific student
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getAttendances($id)
    {
        $student = Student::find($id);
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }
        
        $attendances = $student->attendances;
        
        return response()->json([
            'success' => true,
            'data' => $attendances
        ]);
    }
    
    /**
     * Get exam results for a specific student
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getExamResults($id)
    {
        $student = Student::find($id);
        
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }
        
        $examResults = $student->examResults()->with(['exam', 'course'])->get();
        
        return response()->json([
            'success' => true,
            'data' => $examResults
        ]);
    }
}