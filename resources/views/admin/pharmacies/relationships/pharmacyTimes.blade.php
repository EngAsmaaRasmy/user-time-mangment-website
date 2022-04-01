@can('time_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.times.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.time.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        Times {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-time">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                           Pharmacy
                        </th>
                        <th>
                            User
                        </th>
                        <th>
                           Weekday
                        </th>
                        <th>
                            Start Time
                        </th>
                        <th>
                            End Time
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($times as $key => $time)
                        <tr data-entry-id="{{ $time->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $time->id ?? '' }}
                            </td>
                            <td>
                                {{ $time->pharmacy->name ?? '' }}
                            </td>
                            <td>
                                {{ $time->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $time->weekday ?? '' }}
                            </td>
                            <td>
                                {{ $time->start_time ?? '' }}
                            </td>
                            <td>
                                {{ $time->end_time ?? '' }}
                            </td>
                            <td>
                                @can('dataRange_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.times.show', $time->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('dataRange_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.times.edit', $time->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('dataRange_delete')
                                    <form action="{{ route('admin.times.destroy', $time->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('dataRange_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.times.massDestroy') }}",
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
  $('.datatable-time:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection