@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.question.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.questions.update", [$question->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                            <label class="required" for="question">{{ trans('cruds.question.fields.question') }}</label>
                            <input class="form-control" type="text" name="question" id="question" value="{{ old('question', $question->question) }}" required>
                            @if($errors->has('question'))
                                <span class="help-block" role="alert">{{ $errors->first('question') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.question_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="image">{{ trans('cruds.question.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('score') ? 'has-error' : '' }}">
                            <label class="required" for="score">{{ trans('cruds.question.fields.score') }}</label>
                            <input class="form-control" type="number" name="score" id="score" value="{{ old('score', $question->score) }}" step="1" required>
                            @if($errors->has('score'))
                                <span class="help-block" role="alert">{{ $errors->first('score') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.question.fields.score_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.questions.storeMedia') }}',
    maxFilesize: 50, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($question) && $question->image)
      var file = {!! json_encode($question->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $question->image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection