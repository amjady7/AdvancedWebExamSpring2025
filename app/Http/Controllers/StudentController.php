<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
    public function index()
    {
        $students = Students::latest()->get();
        return view('students', compact('students'));
    }

    
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age'=> 'required|INT '
        ]);

        // Create the task and return as JSON response
        $student = Student::create([
            'name' => $validated['name'],
            'age'=>$validate['age']
        ]);

        return response()->json($task, 201);
    }

    // Delete a task
    public function destroy(Student $students)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
