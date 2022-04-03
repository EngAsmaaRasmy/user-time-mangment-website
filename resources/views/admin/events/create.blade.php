@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }}  Event
    </div>

    <div class="card-body col-md-6">
        <form method="POST" action="{{ route("admin.storeEvent") }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="table_id" value="{{$tableId}} "/> 
            <div class="form-group">
                <label class="required" for="user_id">Pharmacy</label>
                <select class="form-control select2 {{ $errors->has('pharmacy') ? 'is-invalid' : '' }}" name="pharmacy_id" id="pharmacy_id" required>
                    @foreach($pharmacies as $id => $pharmacy)
                        <option value="{{ $id }}" {{ old('pharmacy_id') == $id ? 'selected' : '' }}>{{ $pharmacy }}</option>
                    @endforeach
                </select>
                @if($errors->has('pharmacy'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pharmacy') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">Day</label>
                <select class="form-control select2 {{ $errors->has('weekday') ? 'is-invalid' : '' }}" name="weekday" id="weekday" required>
                    <option selected>please select</option>
                    @foreach($weekDays as  $weekday)
                        <option value="{{ $weekday }}" {{ old('weekday') == $id ? 'selected' : '' }}>{{ $weekday }}</option>
                    @endforeach
                </select>
                @if($errors->has('weekday'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weekday') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.lesson.fields.start_time') }}</label>
                <input class="form-control lesson-timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.lesson.fields.end_time') }}</label>
                <input class="form-control lesson-timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection