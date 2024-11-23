<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\classItem;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PDO;

class addStudentsController extends Controller
{
    public function index()
    {
        $data = classItem::all();
        return Inertia::render('AddStudents', [
            'dataClass' => $data
        ]);
    }

    public function store(Request $request){
        $validateDData = $request ->validate([
            'name'=>'required|string|max:255',
            'age'=>'required|numeric',
            'class_id'=>'required|numeric',
            'class_name'=>'string|max:255',
            'section_name'=>'string|max:255',
            'section_id'=>'required|numeric'
        ]);

        Student::create($validateDData);

        return redirect()->route('addstudents')->with('succes','Form Submited Succespoleg');
    }

    public function edit($id){
        $data = classItem::all();
        $dataEachStudent = Student::findOrFail($id);

        return Inertia::render('AddStudents',['dataEachStudent' => $dataEachStudent,
        'dataClass' => $data
    ]);

    }

    public function update(Request $request ,$id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'class_id' => 'required|numeric',
            'class_name' => 'string|max:255',
            'section_name' => 'string|max:255',
            'section_id' => 'required|numeric'
        ]);

        // Find the student by ID and update it
        $student = Student::findOrFail($id);
        $student->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('addstudents')->with('success', 'Student Updated Successfully');
    }

    
}
