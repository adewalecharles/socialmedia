<?php

namespace App\Http\Requests;

use App\Test;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('test_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'questions.*' => [
                'integer',
            ],
            'questions'   => [
                'array',
            ],
        ];
    }
}
