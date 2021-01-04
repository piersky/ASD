@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('settings.Settings')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('settings.update', ['id' => $user_id])}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                @method('PATCH')
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="year"><strong>{{__('settings.Year')}}</strong></label>
                            <select id="year" name="year" class="form-control">
                                <option value="2020" {{$keys['year']=="2020"?"selected":""}}>2020</option>
                                <option value="2021" {{$keys['year']=="2021"?"selected":""}}>2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="year"><strong>{{__('settings.Language')}}</strong></label>
                            <select id="year" name="year" class="form-control">
                                <option value="en" {{$keys['lang_id']=="en"?"selected":""}}>English</option>
                                <option value="it" {{$keys['lang_id']=="it"?"selected":""}}>Italiano</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <label for="payment_day_month"><strong>{{__('settings.Payment day of month')}}</strong></label>
                            <input type="text" name="payment_day_month" id="payment_day_month" class="form-control" value="{{$keys['payment_day_month']}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="send_email_on_new_payment" id="send_email_on_new_payment" class="form-check-input" {{$keys['send_email_on_new_payment']?"checked":""}}>
                            <label for="send_email_on_new_payment" class="form-check-label" ><strong>{{__('settings.Send email on new payment')}}</strong></label>
                        </div>
                    </div>

                    <a href="/" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
