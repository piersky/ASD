@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1>{{$athlete->lastname}} {{$athlete->firstname}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="row">
            </div>
        </div>
    </div>
@endsection
