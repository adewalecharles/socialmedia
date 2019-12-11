@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.questionsOption.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.questions-options.update", [$questionsOption->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                            <label for="question_id">{{ trans('cruds.questionsOption.fields.question') }}</label>
                            <select class="form-control select2" name="question_id" id="question_id">
                                @foreach($questions as $id => $question)
                                    <option value="{{ $id }}" {{ ($questionsOption->question ? $questionsOption->question->id : old('question_id')) == $id ? 'selected' : '' }}>{{ $question }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('question_id'))
                                <span class="help-block" role="alert">{{ $errors->first('question_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.questionsOption.fields.question_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('option_text') ? 'has-error' : '' }}">
                            <label class="required" for="option_text">{{ trans('cruds.questionsOption.fields.option_text') }}</label>
                            <input class="form-control" type="text" name="option_text" id="option_text" value="{{ old('option_text', $questionsOption->option_text) }}" required>
                            @if($errors->has('option_text'))
                                <span class="help-block" role="alert">{{ $errors->first('option_text') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.questionsOption.fields.option_text_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('correct') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="correct" value="0">
                                <input type="checkbox" name="correct" id="correct" value="1" {{ $questionsOption->correct || old('correct', 0) === 1 ? 'checked' : '' }}>
                                <label for="correct" style="font-weight: 400">{{ trans('cruds.questionsOption.fields.correct') }}</label>
                            </div>
                            @if($errors->has('correct'))
                                <span class="help-block" role="alert">{{ $errors->first('correct') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.questionsOption.fields.correct_helper') }}</span>
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