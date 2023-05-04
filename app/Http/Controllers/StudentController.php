<?php

namespace App\Http\Controllers;

use Domain\Facades\StudentFacade;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use JetBrains\PhpStorm\NoReturn;

class StudentController extends Controller
{
    //Show add new student page
    public function viewAddStudent(Request $request): \Inertia\Response
    {
        return Inertia::render('Student/store', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    //Show all student page
    public function viewAllStudent(): \Inertia\Response
    {
        $response['students'] = StudentFacade::getAll();
        return Inertia::render('Student/view',$response);
    }

    //Show edit student page
    public function viewEditStudent(Request $request): \Inertia\Response
    {
        $response['student'] = StudentFacade::getStudent($request->id);
        return Inertia::render('Student/edit',$response);
    }

    #[NoReturn] public function storeStudent(Request $request) {
        $validated = $request->validate([
            'student_name' => 'required|min:3',
            'student_image' => 'mimes:jpeg,jpg,png,gif',
            'student_age' => 'required|numeric|max:20'
        ]);
        StudentFacade::save($request->all());
    }

    //Change status
    #[NoReturn] public function changeStatus(Request $request) {
        StudentFacade::chageStatus($request->id);
    }

    //Delete Student
    public function delete(Request $request) {
        $response['students'] =  StudentFacade::delete($request->id);
        return Inertia::render('Student/view',$response);
    }

    //Update Student
    public function update(Request $request)
    {
        StudentFacade::update($request->all());
    }
}
