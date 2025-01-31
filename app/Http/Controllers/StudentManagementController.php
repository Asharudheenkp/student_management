<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentMarkStoreRequest;

use App\Models\StudentMark;
use App\Models\Subject;

class StudentManagementController extends Controller
{
    /**
     *This will show the student mark listing page
     *
     * @return \Illuminate\View\View;
     */
    public function index()
    {
        $studentMarks = StudentMark::with('subject')->select('id', 'student_name', 'subject_id', 'mark')->paginate(10);
        return view('pages.student.index', compact('studentMarks'));
    }

    /**
     * This will show the user mark add page
     *
     * @return \Illuminate\View\View;
     */
    public function create()
    {
        $subjects = Subject::select('id', 'subject_name')->get();
        return view('pages.student.create', compact('subjects'));
    }

    /**
     * This will store student mark in the database
     *
     * @param StudentMarkStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentMarkStoreRequest $request)
    {
        $data = [];
        foreach ($request->subject_id as $key => $subject) {
            $data[$key]['subject_id'] = $subject;
            $data[$key]['mark'] = $request->mark[$key];
            $data[$key]['student_name'] = $request->student_name;
        }

        StudentMark::insert($data);
        flash()->success('Student mark added successfully.');
        return response()->json(['status' => true, 'url' => route('stutdent.index')]);
    }

    /**
     * This will delete student mark in the database
     *
     * @param StudentMarkStoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(StudentMark $studentMark)
    {
        $studentMark->delete();
        flash()->success('Student mark deleted successfully.');
        return to_route('stutdent.index');
    }
}
