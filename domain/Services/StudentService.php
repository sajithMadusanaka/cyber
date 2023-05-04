<?php

namespace Domain\Services;

use App\Models\Student;
use Domain\Facades\ImagesFacade;

class StudentService
{
    protected Student $student;

    public function __construct()
    {
        $this->student = new Student();
    }

    //Save student data
    public function save($data): void
    {   $path = ImagesFacade::storeImage($data['student_image']);
        if ($path != null) {
            $data['student_image'] = $path;
            $this->student->create($data);
        }
    }

    //Get all student data
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->student::all();
    }

    //Change Status
    public function chageStatus($id): void
    {
        $std = $this->student::find($id);
        if ($std->student_status == 0) {
            $std->student_status = true;
        } else {
            $std->student_status = false;
        }
        $std->save();
    }

    //Delete student
    public function delete($id): \Illuminate\Database\Eloquent\Collection
    {
        $std = $this->student::find($id);
        ImagesFacade::deleteImage($std->student_image);
        $std->delete();
        return $this->student::all();
    }

    //Get a student
    public function getStudent($id) {
        return $this->student::find($id);
    }
    //Update Student
    public function update($data): void
    {
        $std = $this->student::find($data['student_id']);
        if ($data['student_image'] != null) {
            ImagesFacade::deleteImage($data['old_image']);
            $path = ImagesFacade::storeImage($data['student_image']);
            $std->student_image = $path;
        }
        $std->student_name = $data['student_name'];
        $std->student_age = $data['student_age'];
        $std->save();
    }
}
