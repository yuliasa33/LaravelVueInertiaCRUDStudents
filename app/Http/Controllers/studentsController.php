<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\classItem;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class studentsController extends Controller
{
    public function index()
    {
        $student = Student::all();
        $classItems = classItem::all();

      

        return Inertia::render('Students', [
            'classItems'=>$classItems,
            'students' => $student
        ]);
    }

    public function getClassItem(){
    
    }

    public function destroy($id)
    {
        $item = Student::find($id);

        if ($item) {
            $item->delete(); 
            return Inertia::render('Students', [
                'students' => Student::all(),
                'message' => 'Item deleted successfully.'
            ]);
            return redirect()->route('students')->with('success', 'Item deleted successfully.');
            
        }
        return redirect()->route('students')->with('error', 'Item not found.');
    }

   

}
