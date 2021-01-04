@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{$group->name}}</h1>
            </div>
            <div class="col-sm-4 d-flex justify-content-end mb-4">
                <a class="btn btn-danger" href="/groups/{{$group->id}}/paymentsPDF">PDF</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-uppercase">{{__('Athlete')}}</th>
                            <th scope="col" class="text-uppercase">{{__('Enrollment')}}</th>
                            <th scope="col" class="text-uppercase">{{__('1st_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('2nd_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('3rd_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('4th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('5th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('6th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('7th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('8th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('9th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('10th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('11th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('12th_fee')}}</th>
                            <th scope="col" class="text-uppercase">{{__('Total')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($athletes as $athlete)
                            <tr>
                                <th scope="row" class="text-uppercase"><a href="/athletes/{{$athlete->athlete_id}}">{{$athlete->lastname}} {{$athlete->firstname}}</a></th>
                                @foreach($athlete->period_payments as $period_payment)
                                    <td class="alert alert-{{$period_payment['amount']==0?"danger":"success"}}">
                                        <div class="d-flex justify-content-end">
                                            @if($period_payment['amount']>0)
                                                <a href="/payments/{{$period_payment['id']}}">@money($period_payment['amount'])</a>
                                            @endif
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            @if($period_payment['amount']>0)
                                                <a href="/payments/{{$period_payment['id']}}">{{date('d/m/Y', strtotime($period_payment['date']))}}</a>
                                            @endif
                                        </div>
                                    </td>
                                @endforeach
                                <td><div class="d-flex justify-content-end">@money($athlete->total)</div></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
