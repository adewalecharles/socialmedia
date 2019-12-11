@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.lesson.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.lessons.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $lesson->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.course') }}
                                    </th>
                                    <td>
                                        {{ $lesson->course->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.title') }}
                                    </th>
                                    <td>
                                        {{ $lesson->title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.decription') }}
                                    </th>
                                    <td>
                                        {!! $lesson->decription !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $lesson->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.image') }}
                                    </th>
                                    <td>
                                        @foreach($lesson->image as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                <img src="{{ $media->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.video') }}
                                    </th>
                                    <td>
                                        @foreach($lesson->video as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.downloadable_file') }}
                                    </th>
                                    <td>
                                        @foreach($lesson->downloadable_file as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.lesson.fields.active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $lesson->active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.lessons.index') }}">
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
                        <a href="#lesson_tests" aria-controls="lesson_tests" role="tab" data-toggle="tab">
                            {{ trans('cruds.test.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="lesson_tests">
                        @includeIf('admin.lessons.relationships.lessonTests', ['tests' => $lesson->lessonTests])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection