<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\\App\\User',
            'date_field' => 'birthday',
            'field'      => 'birthday',
            'prefix'     => 'User',
            'suffix'     => 'has birthday today',
            'route'      => 'admin.users.edit',
        ],
        [
            'model'      => '\\App\\Test',
            'date_field' => 'created_at',
            'field'      => 'title',
            'prefix'     => 'Test',
            'suffix'     => 'You have a new test',
            'route'      => 'admin.tests.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
