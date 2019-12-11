@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.test.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.tests.update", [$test->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('course') ? 'has-error' : '' }}">
                            <label for="course_id">{{ trans('cruds.test.fields.course') }}</label>
                            <select class="form-control select2" name="course_id" id="course_id">
                                @foreach($courses as $id => $course)
                                    <option value="{{ $id }}" {{ ($test->course ? $test->course->id : old('course_id')) == $id ? 'selected' : '' }}>{{ $course }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('course_id'))
                                <span class="help-block" role="alert">{{ $errors->first('course_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.course_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lesson') ? 'has-error' : '' }}">
                            <label for="lesson_id">{{ trans('cruds.test.fields.lesson') }}</label>
                            <select class="form-control select2" name="lesson_id" id="lesson_id">
                                @foreach($lessons as $id => $lesson)
                                    <option value="{{ $id }}" {{ ($test->lesson ? $test->lesson->id : old('lesson_id')) == $id ? 'selected' : '' }}>{{ $lesson }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('lesson_id'))
                                <span class="help-block" role="alert">{{ $errors->first('lesson_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.lesson_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('questions') ? 'has-error' : '' }}">
                            <label for="questions">{{ trans('cruds.test.fields.question') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="questions[]" id="questions" multiple>
                                @foreach($questions as $id => $question)
                                    <option value="{{ $id }}" {{ (in_array($id, old('questions', [])) || $test->questions->contains($id)) ? 'selected' : '' }}>{{ $question }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('questions'))
                                <span class="help-block" role="alert">{{ $errors->first('questions') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.question_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label for="title">{{ trans('cruds.test.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $test->title) }}">
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.test.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $test->description) !!}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('published') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="published" value="0">
                                <input type="checkbox" name="published" id="published" value="1" {{ $test->published || old('published', 0) === 1 ? 'checked' : '' }}>
                                <label for="published" style="font-weight: 400">{{ trans('cruds.test.fields.published') }}</label>
                            </div>
                            @if($errors->has('published'))
                                <span class="help-block" role="alert">{{ $errors->first('published') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.test.fields.published_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection