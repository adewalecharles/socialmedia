@extends('layouts.admin')
@section('content')
<div class="content">
    @can('course_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.courses.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.course.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.course.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Course">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.slug') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.intro_video') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.picture') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.published') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.teacher') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.updated_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.course.fields.deleted_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $key => $course)
                                    <tr data-entry-id="{{ $course->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $course->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->slug ?? '' }}
                                        </td>
                                        <td>
                                            @if($course->intro_video)
                                                <a href="{{ $course->intro_video->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($course->picture)
                                                <a href="{{ $course->picture->getUrl() }}" target="_blank">
                                                    <img src="{{ $course->picture->getUrl('thumb') }}" width="50px" height="50px">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $course->start_date ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $course->published ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $course->published ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @foreach($course->teachers as $key => $item)
                                                <span class="label label-info label-many">{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $course->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $course->deleted_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('course_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.courses.show', $course->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('course_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.courses.edit', $course->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('course_delete')
                                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('course_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.courses.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Course:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection