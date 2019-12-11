@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.course.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $course->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $course->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $course->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $course->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.intro_video') }}
                                    </th>
                                    <td>
                                        @if($course->intro_video)
                                            <a href="{{ $course->intro_video->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.picture') }}
                                    </th>
                                    <td>
                                        @if($course->picture)
                                            <a href="{{ $course->picture->getUrl() }}" target="_blank">
                                                <img src="{{ $course->picture->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $course->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.published') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $course->published ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.teacher') }}
                                    </th>
                                    <td>
                                        @foreach($course->teachers as $key => $teacher)
                                            <span class="label label-info">{{ $teacher->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.course.fields.created_at') }}
                                    </th>
                                    <td>
                                        {{ $course->created_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.courses.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.relatedData') }}
                </div>
                <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                    <li role="presentation">
                        <a href="#course_lessons" aria-controls="course_lessons" role="tab" data-toggle="tab">
                            {{ trans('cruds.lesson.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#course_tests" aria-controls="course_tests" role="tab" data-toggle="tab">
                            {{ trans('cruds.test.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="course_lessons">
                        @includeIf('admin.courses.relationships.courseLessons', ['lessons' => $course->courseLessons])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="course_tests">
                        @includeIf('admin.courses.relationships.courseTests', ['tests' => $course->courseTests])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection