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
                            <input type="date" required name="payment_date" id="payment_date" class="form-control" value="{{old('payment_date')}}">
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="athlete_id"><strong>{{__('payments.Athlete')}}*</strong></label>
                            <select id="athlete_id" name="athlete_id" class="form-control">
                                @foreach($athletes as $athlete)
                                    <option value="{{$athlete->id}}">{{$athlete->lastname}} {{$athlete->firstname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="amount"><strong>{{__('payments.Amount')}}*</strong></label>
                            <input type="number" step="0.01" required name="amount" id="amount" class="form-control" value="{{old('amount')}}" placeholder={{__('payments.Payment amount')}}>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="period"><strong>{{__('payments.Period')}}*</strong></label>
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
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="method"><strong>{{__('payments.Method of payment')}}*</strong></label>
                            <select id="method" name="method" class="form-control">
                                <option value="CASH">{{__('payments.CASH')}}</option>
                                <option value="BANK WIRE">{{__('payments.BANK WIRE')}}</option>
                                <option value="CHECK">{{__('payments.CHECK')}}</option>
                                <option value="POS">{{__('payments.POS')}}</option>
                                <option value="OTHER">{{__('payments.OTHER METHODS')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="note"><strong>{{__('payments.Notes')}}*</strong></label>
                        <input type="text" name="note" id="note" class="form-control" value="{{old('note')}}" placeholder={{__('payments.Notes')}}>
                    </div>
                    <a href="/payments" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
