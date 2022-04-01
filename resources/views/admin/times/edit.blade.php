@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lesson.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.times.update", [$time->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="pharmacy_id">Pharmacy</label>
                <select class="form-control select2 {{ $errors->has('pharmacy') ? 'is-invalid' : '' }}" name="pharmacy_id" id="pharmacy_id" required>
                    @foreach($pharmacies as $id => $pharmacy)
                        <option value="{{ $id }}" {{ ($time->pharmacy ? $time->pharmacy->id : old('pharmacy_id')) == $id ? 'selected' : '' }}>{{ $pharmacy }}</option>
                    @endforeach
                </select>
                @if($errors->has('pharmacy'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pharmacy') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.class_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">User</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($time->user ? $time->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.teacher_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="weekday">{{ trans('cruds.lesson.fields.weekday') }}</label>
                <input class="form-control {{ $errors->has('weekday') ? 'is-invalid' : '' }}" type="number" name="weekday" id="weekday" value="{{ old('weekday', $time->weekday) }}" step="1" required>
                @if($errors->has('weekday'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weekday') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.weekday_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.lesson.fields.start_time') }}</label>
                <input class="form-control lesson-timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $time->start_time) }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lesson.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.lesson.fields.end_time') }}</label>
                <input class="form-control lesson-timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $time->end_time) }}" required>
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