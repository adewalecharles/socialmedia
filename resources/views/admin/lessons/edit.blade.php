@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.lesson.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.lessons.update", [$lesson->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('course') ? 'has-error' : '' }}">
                            <label class="required" for="course_id">{{ trans('cruds.lesson.fields.course') }}</label>
                            <select class="form-control select2" name="course_id" id="course_id" required>
                                @foreach($courses as $id => $course)
                                    <option value="{{ $id }}" {{ ($lesson->course ? $lesson->course->id : old('course_id')) == $id ? 'selected' : '' }}>{{ $course }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('course_id'))
                                <span class="help-block" role="alert">{{ $errors->first('course_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lesson.fields.course_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="required" for="title">{{ trans('cruds.lesson.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" required>
                            @if($errors->has('title'))
                                <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lesson.fields.title_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('decription') ? 'has-error' : '' }}">
                            <label for="decription">{{ trans('cruds.lesson.fields.decription') }}</label>
                            <textarea class="form-control ckeditor" name="decription" id="decription">{!! old('decription', $lesson->decription) !!}</textarea>
                            @if($errors->has('decription'))
                                <span class="help-block" role="alert">{{ $errors->first('decription') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lesson.fields.decription_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                            <label for="slug">{{ trans('cruds.lesson.fields.slug') }}</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ old('slug', $lesson->slug) }}">
                            @if($errors->has('slug'))
                                <span class="help-block" role="alert">{{ $errors->first('slug') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lesson.fields.slug_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="image">{{ trans('cruds.lesson.fields.image') }}</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lesson.fields.image_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('video') ? 'has-error' : '' }}">
                            <label for="video">{{ trans('cruds.lesson.fields.video') }}</label>
                            <div class="needsclick dropzone" id="video-dropzone">
                            </div>
                            @if($errors->has('video'))
                                <span class="help-block" role="alert">{{ $errors->first('video') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lesson.fields.video_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('downloadable_file') ? 'has-error' : '' }}">
                            <label for="downloadable_file">{{ trans('cruds.lesson.fields.downloadable_file') }}</label>
                            <div class="needsclick dropzone" id="downloadable_file-dropzone">
                            </div>
                            @if($errors->has('downloadable_file'))
                                <span class="help-block" role="alert">{{ $errors->first('downloadable_file') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lesson.fields.downloadable_file_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="active" value="0">
                                <input type="checkbox" name="active" id="active" value="1" {{ $lesson->active || old('active', 0) === 1 ? 'checked' : '' }}>
                                <label for="active" style="font-weight: 400">{{ trans('cruds.lesson.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <span class="help-block" role="alert">{{ $errors->first('active') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.lesson.fields.active_helper') }}</span>
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
    var uploadedImageMap = {}
Dropzone.options.imageDropzone = {
    url: '{{ route('admin.lessons.storeMedia') }}',
    maxFilesize: 50, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
      uploadedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImageMap[file.name]
      }
      $('form').find('input[name="image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lesson) && $lesson->image)
      var files =
        {!! json_encode($lesson->image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
        }
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
    var uploadedVideoMap = {}
Dropzone.options.videoDropzone = {
    url: '{{ route('admin.lessons.storeMedia') }}',
    maxFilesize: 100, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 100
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="video[]" value="' + response.name + '">')
      uploadedVideoMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedVideoMap[file.name]
      }
      $('form').find('input[name="video[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lesson) && $lesson->video)
          var files =
            {!! json_encode($lesson->video) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="video[]" value="' + file.file_name + '">')
            }
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
    var uploadedDownloadableFileMap = {}
Dropzone.options.downloadableFileDropzone = {
    url: '{{ route('admin.lessons.storeMedia') }}',
    maxFilesize: 50, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="downloadable_file[]" value="' + response.name + '">')
      uploadedDownloadableFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDownloadableFileMap[file.name]
      }
      $('form').find('input[name="downloadable_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lesson) && $lesson->downloadable_file)
          var files =
            {!! json_encode($lesson->downloadable_file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="downloadable_file[]" value="' + file.file_name + '">')
            }
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