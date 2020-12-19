@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('parents.Parents')}}</h1>
            </div>
            @if(session()->has('message'))
                @component('components.alert-info')
                    {{session()->get('message')}}
                @endcomponent
            @endif
            <div class="col-sm-10">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
