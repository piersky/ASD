@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('payments.Payment')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="payment_date"><strong>{{__('payments.Payment date')}}*</strong></label>
                        <input type="date" readonly name="payment_date" id="payment_date" class="form-control" value="{{old('payment_date', $payment->payment_date)}}">
                    </div>
                    <div class="form-group col-sm-9">
                        <label for="athlete"><strong>{{__('payments.Athlete')}}*</strong></label>
                        <input readonly class="form-control" name="athlete" value="{{$athlete[0]->lastname}} {{$athlete[0]->firstname}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="amount"><strong>{{__('payments.Amount')}}*</strong></label>
                        <input type="number" readonly step="0.01" name="amount" id="amount" class="form-control" value="{{old('amount', $payment->amount)}}">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="period"><strong>{{__('payments.Period')}}*</strong></label>
                        <input readonly class="form-control" value="{{__($payment->period)}}">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="method"><strong>{{__('payments.Method of payment')}}*</strong></label>
                        <input readonly class="form-control" value="{{__($payment->method)}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="note"><strong>{{__('payments.Notes')}}</strong></label>
                    <input type="text" readonly name="note" id="note" class="form-control" value="{{old('note', $payment->note)}}">
                </div>
                <a href="/payments" class="btn btn-danger">{{__('Cancel')}}</a>
                <a href="/payments/{{$payment->id}}/edit" class="btn btn-info text-uppercase text-white">{{__('Edit')}}</a>
            </div>
        </div>
    </div>
@endsection
