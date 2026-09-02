<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
   public function index(Request $request)
   {
      $search = $request->search;
      $students = Student::when($search,function ($query,$search) {
       return $query->where('name','like','%'.$search . '%');})->latest()->get();
      
      $totalStudents = Student::count();
      
      return view('students',compact('students','totalStudents'));
   }

   public function store(Request $request)
{
    Student::create([
        'name' => $request->name,
        'email' => $request->email,
        'course' => $request->course,
    ]);

    return redirect('/students');
}
 public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);
    $student->update([
        'name' => $request->name,
        'email' => $request->email,
        'course' => $request->course,
        'department' => $request->department,
    ]);

    return redirect('/students')->with('success','Student updated successfully.');
}

  public function destroy($id)
{
    $student = Student::findOrFail($id);

    $student->delete();

    return redirect('/students')->with('success', 'Student deleted successfully.');
}

}