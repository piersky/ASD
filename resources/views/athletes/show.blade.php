@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                @if($athlete->photo ?? '')
                    <img src="{{asset($athlete->path)}}" width="100px">
                @endif
            </div>
            <div class="col-sm-6">
                <h1 class="text-uppercase">{{$athlete->lastname}} {{$athlete->firstname}}</h1>
                <h2>{{__('athletes.Group:')}} {{count($group)>0?$group[0]->name:""}} <a href="{{route('groups.composition.components', $group[0]->id)}}"><span class="fa fa-arrow-right"></span></a></h2>
            </div>
            <div class="col-sm-2">
                <a href="/athletes/{{$athlete->id}}/edit" class="btn btn-success"><span class="fa fa-pencil-alt"></span></a>
                <a href="/athletes/{{$athlete->id}}/payments" class="btn btn-warning"><span class="fa fa-euro"></span></a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group col-sm-5">
                        <label for="">{{__('athletes.Last Name')}}</label>
                        <input type="text" readonly name="lastname" id="lastname" class="form-control" value="{{old('lastname', $athlete->lastname)}}">
                    </div>
                    <div class="form-group col-sm-5">
                        <label for="firstname">{{__('athletes.First Name')}}</label>
                        <input type="text" readonly name="firstname" id="firstname" class="form-control" value="{{old('firstname', $athlete->firstname)}}">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="gender">{{__('athletes.Gender')}}</label>
                        <input type="text" readonly name="gender" id="gender" class="form-control" value={{$athlete->gender=="F"?__('athletes.Female'):__('athletes.Male')}}>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="">{{__('athletes.Date of birth')}}</label>
                        <input type="date" readonly name="date_of_birth" id="date_of_birth" class="form-control" value="{{old('date_of_birth', $athlete->date_of_birth)}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">{{__('athletes.Municipality of birth')}}</label>
                        <input type="text" readonly name="birth_municipality" id="birth_municipality" class="form-control" value="{{old('birth_municipality', $athlete->birth_municipality)}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">{{__('athletes.Province of birth')}}</label>
                        <input type="text" readonly name="birth_province" id="birth_province" class="form-control" value="{{old('birth_province', $athlete->birth_province)}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">{{__('athletes.Birth Country')}}</label>
                        <input type="text" readonly name="birth_country" id="birth_country" class="form-control" value="{{old('birth_country', $athlete->birth_country)}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="fiscal_code"><strong>{{__('athletes.Fiscal code')}}</strong></label>
                        <input type="text" readonly name="fiscal_code" id="fiscal_code" class="form-control" value="{{old('fiscal_code', $athlete->fiscal_code)}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="expiry_medical_certificate_at"><strong>{{__('athletes.Date medical certificate')}}</strong></label>
                        <input type="date" readonly name="expiry_medical_certificate_at" id="expiry_medical_certificate_at" class="form-control" value="{{old('date_medical_certificate', $athlete->date_medical_certificate)}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="phone"><strong>{{__('athletes.Phone')}}</strong></label>
                        <input type="text" readonly name="phone" id="phone" class="form-control" value="{{old('phone', $athlete->phone)}}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email"><strong>{{__('athletes.Email')}}</strong></label>
                        <input type="text" readonly name="email" id="email" class="form-control" value="{{old('email', $athlete->email)}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="">{{__('athletes.Address')}}</label>
                        <input type="text" readonly name="address" id="address" class="form-control" value="{{old('address', $athlete->address)}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="">{{__('athletes.Municipality')}}</label>
                        <input type="text" readonly name="municipality" id="municipality" class="form-control" value="{{old('municipality', $athlete->municipality)}}">
                    </div>
                    <div class="form-group col-4">
                        <label for="">{{__('athletes.Province')}}</label>
                        <input type="text" readonly name="province" id="province" class="form-control" value="{{old('province', $athlete->province)}}">
                    </div>
                    <div class="form-group col-4">
                        <label for="">{{__('athletes.Country')}}</label>
                        <input type="text" readonly name="country" id="country" class="form-control" value="{{old('country', $athlete->country)}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-3">
                        <label for="begin_with_us_at"><strong>{{__('athletes.Begun with us')}}</strong></label>
                        <input type="date" readonly name="begin_with_us_at" id="begin_with_us_at" class="form-control" value="{{$athlete->begin_with_us_at}}">
                    </div>
                    <div class="form-group col-3">
                        <label for="end_with_us_at"><strong>{{__('athletes.End with us')}}</strong></label>
                        <input type="date" readonly name="end_with_us_at" id="end_with_us_at" class="form-control" value="{{$athlete->end_with_us_at}}">
                    </div>
                    <div class="form-group col-6">
                        <label for="society_come_from"><strong>{{__('athletes.Name of the society')}}</strong></label>
                        <input type="text" readonly name="society_come_from" id="society_come_from" class="form-control" value="{{$athlete->society_come_from}}" placeholder="{{__('athletes.The name of the society')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-1">
                        <label for="">{{__('athletes.Is active')}}</label>
                        <input type="checkbox" readonly name="is_active" id="is_active" class="form-control" {{$athlete->is_active==1?"checked":""}}>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
