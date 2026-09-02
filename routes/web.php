<?php

use Illuminate\Support\Facades\Route;
use
 App\Http\Controllers\studentController;

 Route::get('/', function () {
    return('welcome to Student Management System');
});

Route::get('/students',
    [StudentController::class, 'index']);
Route::post('/students/store', [StudentController::class, 'store']);
    
Route::get('/courses', function () {
    return view('Courses');

Route::delete('/students/{id}', [StudentController::class, 'destroy'])
    ->name('students.destroy');


});
Route::get('/departments', function () {
    return view('Departments');

});
Route::put('/students/{id}', [StudentController::class,'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class,'destroy']) ->name('students.destroy');
