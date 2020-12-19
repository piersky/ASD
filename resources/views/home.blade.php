@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-sm-2">
            <div class="card">
                <div class="card-header text-uppercase bg-info text-white">{{ __('Main menu') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{url('/athletes')}}">Atleti</a></li>
                            <li class="list-group-item"><a href="{{url('/parents')}}">Genitori</a></li>
                            <li class="list-group-item"><a href="{{url('/payments')}}">Pagamenti</a></li>
                            <li class="list-group-item"><a href="{{url('/groups')}}">Gruppi</a></li>
                            <li class="list-group-item"><a href="#">{{__('Help')}}</a></li>
                        </ul>
                </div>
            </div>
        </div>
        @if(count($last_payment)!=0)
        <div class="col-sm-10">
            <div class="row mb-5">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="d-flex justify-content-between align-items-center text-uppercase">
                                {{__('Last stored payment')}}
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{__('Last payment is ')}}</p>
                            <p class="card-text">{{date('d/m/Y', strtotime($last_payment[0]->payment_date))}},
                                {{$last_payment[0]->lastname}} {{$last_payment[0]->firstname}}
                                @money($last_payment[0]->amount)</p>
                            <a href="{{url('/payments')}}" class="btn btn-primary text-uppercase">{{__('Go to Payments')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3 class="d-flex justify-content-between align-items-center text-uppercase text-white">
                                {{__('Number of athletes')}}
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{__('Currently the total number of athlete is ')}}</p>
                            <h1>{{$total_athletes}}</h1>
                            <a href="{{url('/athletes')}}" class="btn btn-primary text-uppercase">{{__('Go to Athletes')}}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="d-flex justify-content-between align-items-center text-uppercase text-white">
                                {{__('Groups')}}
                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{__('Number of groups')}}</p>
                            <p class="card-text">1</p>
                            <a href="{{url('/groups')}}" class="btn btn-primary text-uppercase">{{__('Go to Groups')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="d-flex justify-content-between align-items-center text-uppercase">

                            </h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text"></p>
                            <h1></h1>
                            <a href="#" class="btn btn-primary text-uppercase"></a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
