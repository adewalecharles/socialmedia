<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLessonRequest;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Lesson;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::all();

        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessons.create', compact('courses'));
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = Lesson::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $lesson->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        foreach ($request->input('video', []) as $file) {
            $lesson->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('video');
        }

        foreach ($request->input('downloadable_file', []) as $file) {
            $lesson->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('downloadable_file');
        }

        return redirect()->route('admin.lessons.index');
    }

    public function edit(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lesson->load('course');

        return view('admin.lessons.edit', compact('courses', 'lesson'));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->all());

        if (count($lesson->image) > 0) {
            foreach ($lesson->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $lesson->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lesson->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        if (count($lesson->video) > 0) {
            foreach ($lesson->video as $media) {
                if (!in_array($media->file_name, $request->input('video', []))) {
                    $media->delete();
                }
            }
        }

        $media = $lesson->video->pluck('file_name')->toArray();

        foreach ($request->input('video', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lesson->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('video');
            }
        }

        if (count($lesson->downloadable_file) > 0) {
            foreach ($lesson->downloadable_file as $media) {
                if (!in_array($media->file_name, $request->input('downloadable_file', []))) {
                    $media->delete();
                }
            }
        }

        $media = $lesson->downloadable_file->pluck('file_name')->toArray();

        foreach ($request->input('downloadable_file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $lesson->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('downloadable_file');
            }
        }

        return redirect()->route('admin.lessons.index');
    }

    public function show(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->load('course', 'lessonTests');

        return view('admin.lessons.show', compact('lesson'));
    }

    public function destroy(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonRequest $request)
    {
        Lesson::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
