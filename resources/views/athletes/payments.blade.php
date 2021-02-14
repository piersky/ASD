@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1>{{$athlete->lastname}} {{$athlete->firstname}} ({{$athlete->gender}})
                    <a href="/athletes/{{$athlete->id}}/edit" class="btn btn-success"><span class="fa fa-pencil-alt"></span></a>
                </h1>
                <h2 class="col-sm-8 px-2 py-2 my-3 bg-warning">
                    @if($athlete->group_name ?? '')
                        {{$athlete->group_name}}
                    @else ---
                    @endif
                </h2>
                <dl class="row">
                    <dt class="col-sm-2">{{__('athletes.Fiscal Code')}}</dt>
                    <dd class="col-sm-4">{{$athlete->fiscal_code}}</dd>
                    <dt class="col-sm-2">{{__('athletes.Date of birth')}}</dt>
                    <dd class="col-sm-4">{{date('d/m/Y', strtotime($athlete->date_of_birth))}}</dd>
                    <dt class="col-sm-2">{{__('athletes.Phone')}}</dt>
                    <dd class="col-sm-4">{{$athlete->phone}}</dd>
                    <dt class="col-sm-2">{{__('athletes.Email')}}</dt>
                    <dd class="col-sm-4">{{$athlete->email}}</dd>
                </dl>
                <h3 class="col-sm-4 px-2 py-2 my-3 bg-success text-light">{{__('athletes.Total')}}: @money($total)</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
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
                                <th scope="col" class="text-uppercase">{{__('1ex_fee')}}</th>
                                <th scope="col" class="text-uppercase">{{__('2ex_fee')}}</th>
                                <th scope="col" class="text-uppercase">{{__('3ex_fee')}}</th>
                                <th scope="col" class="text-uppercase">{{__('4ex_fee')}}</th>
                            </tr>
                        </thead>
                        @if(count($payments)>0)
                        <tbody>
                            <tr>
                                @foreach($period_payments as $period_payment)
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
                            </tr>
                        </tbody>
                            @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
