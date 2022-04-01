@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-3 statistis alert-success">
                                <p style="font-size: 18px">Time Counts</p>
                                <h1 style="font-size: 40px">{{$times}}</h1>   
                            </div>
                            <div class="col-md-3 mx-5  statistis alert-info">
                                <p style="font-size: 18px">Pharmacy Counts</p>
                                <h1 style="font-size: 40px">{{$pharmacies}}</h1> 
                            </div>
                            <div class="col-md-3  statistis alert-primary">
                                <p style="font-size: 18px">User Counts</p>
                                <h1 style="font-size: 40px">{{$users}}</h1> 
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mt-5">
                            <div class="col-md-3  statistis alert-secondary mx-5">
                                <p style="font-size: 18px">Permission Counts</p>
                                <h1 style="font-size: 40px">{{$permissions}}</h1> 
                            </div>
                            <div class="col-md-3  statistis alert-danger mx-5">
                                <p style="font-size: 18px">Role Counts</p>
                                <h1 style="font-size: 40px">{{$roles}}</h1> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
<style>
    .statistis{
  padding: 16px;
  text-align: center;
  
    }
</style>