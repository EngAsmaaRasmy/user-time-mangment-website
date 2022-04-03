@extends('layouts.admin')
@section('content')
@can('dataRange_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.times.create") }}">
               Add Time Table
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Time Tables {{ trans('global.list') }}
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
                            User
                        </th>
                        <th>
                            Start Date
                        </th>
                        <th>
                            End Date
                        </th>
                        <th>
                            Schedule
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
                                {{ $time->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $time->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $time->end_date ?? '' }}
                            </td>
                            <td>
                                <a>
                                    <form action="{{ route('admin.calendar.index') }}?user_id={{ $time->user->id }}">
                                        <input type="hidden" name="start_date" value="{{ $time->start_date}}">
                                        <input type="hidden" name="end_date" value="{{ $time->end_date}}">
                                        <input type="hidden" name="table_id" value="{{ $time->id}}">
                                        <input class="btn btn-primary" type="submit" value="View Schedule"/>
                                    </form>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
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