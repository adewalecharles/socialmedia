<?php

namespace App\Http\Requests;

use App\Course;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'title'      => [
                'min:1',
                'max:500',
                'required',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'teachers.*' => [
                'integer',
            ],
            'teachers'   => [
                'required',
                'array',
            ],
        ];
    }
}
