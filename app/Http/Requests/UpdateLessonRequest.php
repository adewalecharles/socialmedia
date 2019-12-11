<?php

namespace App\Http\Requests;

use App\Lesson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLessonRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'course_id' => [
                'required',
                'integer',
            ],
            'title'     => [
                'min:1',
                'max:5000',
                'required',
                'unique:lessons,title,' . request()->route('lesson')->id,
            ],
        ];
    }
}
