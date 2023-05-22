<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login/login_page');
});

Route::get('login', function () {
    return view('login/login_page');
})->name("login");



Route::get('employee-main', function(){
    return view('employee/employee_main_page');
});

Route::get('employee-students-list', function(){
    return view('employee/employee_students_list');
});

Route::get('employee-info', function(){
    return view('employee/employee_info');
});

Route::get('employee-messages', function(){
    return view('employee/employee_messages');
});

Route::get('employee-activities', function(){
    return view('employee/employee_activities');
});

Route::get('employee-password', function(){
    return view('employee/employee_password');
});





Route::get('student-main', function(){
    return view('student/student_main_page');
});

Route::get('student-info', function(){
    return view('student/student_info');
});

Route::get('student-messages', function(){
    return view('student/student_messages');
});

Route::get('student-activities', function(){
    return view('student/student_activities');
});

Route::get('student-password', function(){
    return view('student/student_password');
});



Route::get('admin', function(){
    return view('login\admin');
});