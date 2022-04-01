@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Pharmacy
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pharmacies.index') }}">
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
                            {{ $pharmacy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $pharmacy->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pharmacies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#pharmacy_times" role="tab" data-toggle="tab">
                Time 
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#pharmacy_users" role="tab" data-toggle="tab">
                User
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="pharmacy_times">
            @includeIf('admin.pharmacies.relationships.pharmacyTimes', ['times' => $pharmacy->pharmacyTimes])
        </div>
        <div class="tab-pane" role="tabpanel" id="pharmacy_users">
            @includeIf('admin.pharmacies.relationships.pharmacyUsers', ['users' => $pharmacy->pharmacyUsers])
        </div>
    </div>
</div>

@endsection