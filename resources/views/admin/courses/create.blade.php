@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.course.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.courses.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.course.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.course.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                            <label for="slug">{{ trans('cruds.course.fields.slug') }}</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                            @if($errors->has('slug'))
                                <span class="help-block" role="alert">{{ $errors->first('slug') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.slug_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('intro_video') ? 'has-error' : '' }}">
                            <label for="intro_video">{{ trans('cruds.course.fields.intro_video') }}</label>
                            <div class="needsclick dropzone" id="intro_video-dropzone">
                            </div>
                            @if($errors->has('intro_video'))
                                <span class="help-block" role="alert">{{ $errors->first('intro_video') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.intro_video_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
                            <label for="picture">{{ trans('cruds.course.fields.picture') }}</label>
                            <div class="needsclick dropzone" id="picture-dropzone">
                            </div>
                            @if($errors->has('picture'))
                                <span class="help-block" role="alert">{{ $errors->first('picture') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.picture_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label for="start_date">{{ trans('cruds.course.fields.start_date') }}</label>
                            <input class="form-control date" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}">
                            @if($errors->has('start_date'))
                                <span class="help-block" role="alert">{{ $errors->first('start_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.start_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('published') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="published" value="0">
                                <input type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 ? 'checked' : '' }}>
                                <label for="published" style="font-weight: 400">{{ trans('cruds.course.fields.published') }}</label>
                            </div>
                            @if($errors->has('published'))
                                <span class="help-block" role="alert">{{ $errors->first('published') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.published_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('teachers') ? 'has-error' : '' }}">
                            <label class="required" for="teachers">{{ trans('cruds.course.fields.teacher') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="teachers[]" id="teachers" multiple required>
                                @foreach($teachers as $id => $teacher)
                                    <option value="{{ $id }}" {{ in_array($id, old('teachers', [])) ? 'selected' : '' }}>{{ $teacher }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('teachers'))
                                <span class="help-block" role="alert">{{ $errors->first('teachers') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.course.fields.teacher_helper') }}</span>
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
    Dropzone.options.introVideoDropzone = {
    url: '{{ route('admin.courses.storeMedia') }}',
    maxFilesize: 100, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 100
    },
    success: function (file, response) {
      $('form').find('input[name="intro_video"]').remove()
      $('form').append('<input type="hidden" name="intro_video" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="intro_video"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($course) && $course->intro_video)
      var file = {!! json_encode($course->intro_video) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="intro_video" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.pictureDropzone = {
    url: '{{ route('admin.courses.storeMedia') }}',
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
      $('form').find('input[name="picture"]').remove()
      $('form').append('<input type="hidden" name="picture" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="picture"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($course) && $course->picture)
      var file = {!! json_encode($course->picture) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $course->picture->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="picture" value="' + file.file_name + '">')
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