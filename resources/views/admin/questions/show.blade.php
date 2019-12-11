@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.question.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.questions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $question->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.question') }}
                                    </th>
                                    <td>
                                        {{ $question->question }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.image') }}
                                    </th>
                                    <td>
                                        @if($question->image)
                                            <a href="{{ $question->image->getUrl() }}" target="_blank">
                                                <img src="{{ $question->image->getUrl('thumb') }}" width="50px" height="50px">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.question.fields.score') }}
                                    </th>
                                    <td>
                                        {{ $question->score }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.questions.index') }}">
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
                        <a href="#question_questions_options" aria-controls="question_questions_options" role="tab" data-toggle="tab">
                            {{ trans('cruds.questionsOption.title') }}
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#question_tests" aria-controls="question_tests" role="tab" data-toggle="tab">
                            {{ trans('cruds.test.title') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="question_questions_options">
                        @includeIf('admin.questions.relationships.questionQuestionsOptions', ['questionsOptions' => $question->questionQuestionsOptions])
                    </div>
                    <div class="tab-pane" role="tabpanel" id="question_tests">
                        @includeIf('admin.questions.relationships.questionTests', ['tests' => $question->questionTests])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection