<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\Admin\CourseResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource(Course::with(['teachers'])->get());
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

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CourseResource($course->load(['teachers']));
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

        return (new CourseResource($course))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
