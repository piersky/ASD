@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1>{{__('payments.New Payment')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <form action="{{route('payments')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="payment_date"><strong>{{__('payments.Payment date')}}*</strong></label>
                            @if($payment_old ?? '')
                                <input type="date" required name="payment_date" id="payment_date" class="form-control" value="{{$payment_old->payment_date}}">
                            @else
                                <input type="date" required name="payment_date" id="payment_date" class="form-control" value="{{old('payment_date')}}">
                            @endif
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="athlete_id"><strong>{{__('payments.Athlete')}}*</strong></label>
                            <select id="athlete_id" name="athlete_id" class="form-control">
                                @foreach($athletes as $athlete)
                                    @if($payment_old ?? '')
                                        <option value="{{$athlete->id}}" {{$athlete->id==$payment_old->athlete_id?"selected":""}}>{{$athlete->lastname}} {{$athlete->firstname}}</option>
                                    @else
                                        <option value="{{$athlete->id}}">{{$athlete->lastname}} {{$athlete->firstname}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="amount"><strong>{{__('payments.Amount')}}*</strong></label>
                            @if($payment_old ?? '')
                                <input type="number" step="0.01" required name="amount" id="amount" class="form-control" value="{{$payment_old->amount}}" placeholder={{__('payments.Payment amount')}}>
                            @else
                                <input type="number" step="0.01" required name="amount" id="amount" class="form-control" value="{{old('amount')}}" placeholder={{__('payments.Payment amount')}}>
                            @endif
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="period"><strong>{{__('payments.Period')}}*</strong></label>
                            @if($payment_old ?? '')
                                <select id="period" name="period" class="form-control">
                                    <option value="Enrollment" {{$payment_old->period=="Enrollment"?"selected":""}}>{{__('payments.Enrollment')}}</option>
                                    <option value="1st_fee" {{$payment_old->period=="1st_fee"?"selected":""}}>{{__('payments.1st_fee')}}</option>
                                    <option value="2nd_fee" {{$payment_old->period=="2nd_fee"?"selected":""}}>{{__('payments.2nd_fee')}}</option>
                                    <option value="3rd_fee" {{$payment_old->period=="3rd_fee"?"selected":""}}>{{__('payments.3rd_fee')}}</option>
                                    <option value="4th_fee" {{$payment_old->period=="4th_fee"?"selected":""}}>{{__('payments.4th_fee')}}</option>
                                    <option value="5th_fee" {{$payment_old->period=="5th_fee"?"selected":""}}>{{__('payments.5th_fee')}}</option>
                                    <option value="6th_fee" {{$payment_old->period=="6th_fee"?"selected":""}}>{{__('payments.6th_fee')}}</option>
                                    <option value="7th_fee" {{$payment_old->period=="7th_fee"?"selected":""}}>{{__('payments.7th_fee')}}</option>
                                    <option value="8th_fee" {{$payment_old->period=="8th_fee"?"selected":""}}>{{__('payments.8th_fee')}}</option>
                                    <option value="9th_fee" {{$payment_old->period=="9th_fee"?"selected":""}}>{{__('payments.9th_fee')}}</option>
                                    <option value="10th_fee" {{$payment_old->period=="10th_fee"?"selected":""}}>{{__('payments.10th_fee')}}</option>
                                    <option value="11th_fee" {{$payment_old->period=="11th_fee"?"selected":""}}>{{__('payments.11th_fee')}}</option>
                                    <option value="12th_fee" {{$payment_old->period=="12th_fee"?"selected":""}}>{{__('payments.12th_fee')}}</option>
                                </select>
                            @else
                                <select id="period" name="period" class="form-control">
                                    <option value="Enrollment">{{__('payments.Enrollment')}}</option>
                                    <option value="1st_fee">{{__('payments.1st_fee')}}</option>
                                    <option value="2nd_fee">{{__('payments.2nd_fee')}}</option>
                                    <option value="3rd_fee">{{__('payments.3rd_fee')}}</option>
                                    <option value="4th_fee">{{__('payments.4th_fee')}}</option>
                                    <option value="5th_fee">{{__('payments.5th_fee')}}</option>
                                    <option value="6th_fee">{{__('payments.6th_fee')}}</option>
                                    <option value="7th_fee">{{__('payments.7th_fee')}}</option>
                                    <option value="8th_fee">{{__('payments.8th_fee')}}</option>
                                    <option value="9th_fee">{{__('payments.9th_fee')}}</option>
                                    <option value="10th_fee">{{__('payments.10th_fee')}}</option>
                                    <option value="11th_fee">{{__('payments.11th_fee')}}</option>
                                    <option value="12th_fee">{{__('payments.12th_fee')}}</option>
                                </select>
                            @endif
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="method"><strong>{{__('payments.Method of payment')}}*</strong></label>
                            @if($payment_old ?? '')
                                <select id="method" name="method" class="form-control">
                                    <option value="CASH" {{$payment_old->method=="CASH"?"selected":""}}>{{__('payments.CASH')}}</option>
                                    <option value="BANK WIRE" {{$payment_old->method=="BANK WIRE"?"selected":""}}>{{__('payments.BANK WIRE')}}</option>
                                    <option value="CHECK" {{$payment_old->method=="CHECK"?"selected":""}}>{{__('payments.CHECK')}}</option>
                                    <option value="POS" {{$payment_old->method=="POS"?"selected":""}}>{{__('payments.POS')}}</option>
                                    <option value="OTHER" {{$payment_old->method=="OTHER"?"selected":""}}>{{__('payments.OTHER METHODS')}}</option>
                                </select>
                            @else
                                <select id="method" name="method" class="form-control">
                                    <option value="CASH">{{__('payments.CASH')}}</option>
                                    <option value="BANK WIRE">{{__('payments.BANK WIRE')}}</option>
                                    <option value="CHECK">{{__('payments.CHECK')}}</option>
                                    <option value="POS">{{__('payments.POS')}}</option>
                                    <option value="OTHER">{{__('payments.OTHER METHODS')}}</option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note"><strong>{{__('payments.Notes')}}</strong></label>
                        <input type="text" name="note" id="note" class="form-control" value="{{old('note')}}" placeholder={{__('payments.Notes')}}>
                    </div>
                    <a href="/payments" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
