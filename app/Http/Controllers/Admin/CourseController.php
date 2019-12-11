<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all();

        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teachers = User::all()->pluck('name', 'id');

        return view('admin.courses.create', compact('teachers'));
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->teachers()->sync($request->input('teachers', []));

        if ($request->input('intro_video', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . $request->input('intro_video')))->toMediaCollection('intro_video');
        }

        if ($request->input('picture', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
        }

        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $teachers = User::all()->pluck('name', 'id');

        $course->load('teachers');

        return view('admin.courses.edit', compact('teachers', 'course'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        $course->teachers()->sync($request->input('teachers', []));

        if ($request->input('intro_video', false)) {
            if (!$course->intro_video || $request->input('intro_video') !== $course->intro_video->file_name) {
                $course->addMedia(storage_path('tmp/uploads/' . $request->input('intro_video')))->toMediaCollection('intro_video');
            }
        } elseif ($course->intro_video) {
            $course->intro_video->delete();
        }

        if ($request->input('picture', false)) {
            if (!$course->picture || $request->input('picture') !== $course->picture->file_name) {
                $course->addMedia(storage_path('tmp/uploads/' . $request->input('picture')))->toMediaCollection('picture');
            }
        } elseif ($course->picture) {
            $course->picture->delete();
        }

        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('teachers', 'courseLessons', 'courseTests');

        return view('admin.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseRequest $request)
    {
        Course::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
