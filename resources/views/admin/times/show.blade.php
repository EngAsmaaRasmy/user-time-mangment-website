@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Time
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.times.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                           ID
                        </th>
                        <td>
                            {{ $time->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Pharmacy
                        </th>
                        <td>
                            {{ $time->pharmacy->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            User
                        </th>
                        <td>
                            {{ $time->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Weekday
                        </th>
                        <td>
                            {{ $time->weekday }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Start Time
                        </th>
                        <td>
                            {{ $time->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            End Date
                        </th>
                        <td>
                            {{ $time->end_time }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.times.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection