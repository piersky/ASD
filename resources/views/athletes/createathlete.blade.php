@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('athletes.New Athlete')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('athletes')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <label for="firstname"><strong>{{__('athletes.First Name')}}*</strong></label>
                            <input type="text" required name="firstname" id="firstname" class="form-control" value="{{old('firstname')}}" placeholder="{{__('athletes.First Name')}}">
                        </div>
                        <div class="form-group col-sm-5">
                            <label for="lastname"><strong>{{__('athletes.Last Name')}}*</strong></label>
                            <input type="text" required name="lastname" id="lastname" class="form-control" value="{{old('lastname')}}" placeholder="{{__('athletes.Last Name')}}">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="gender"><strong>{{__('athletes.Gender')}}</strong></label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="F" selected>{{__('athletes.Female')}}</option>
                                <option value="M">{{__('athletes.Male')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="date_of_birth"><strong>{{__('athletes.Date of birth')}}*</strong></label>
                            <input type="date" required name="date_of_birth" id="date_of_birth" class="form-control" value="{{old('date_of_birth')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="birth_municipality"><strong>{{__('athletes.Municipality of birth')}}*</strong></label>
                            <input type="text" required name="birth_municipality" id="birth_municipality" class="form-control" value="{{old('birth_municipality')}}" placeholder="{{__('athletes.Municipality of birth')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            {{--TODO: Inserire la lista delle province italiane--}}
                            <label for="birth_province"><strong>{{__('athletes.Province of birth')}}*</strong></label>
                            <input type="text" required name="birth_province" id="birth_province" class="form-control" value="{{old('birth_province')}}" placeholder="{{__('athletes.Province of birth')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            {{--TODO: Inserire la lista delle nazioni--}}
                            <label for="birth_country"><strong>{{__('athletes.Birth Country')}}*</strong></label>
                            <input type="text" required name="birth_country" id="birth_country" class="form-control" value="{{old('birth_country')}}" placeholder="{{__('athletes.Birth Country')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="fiscal_code"><strong>{{__('athletes.Fiscal code')}}</strong></label>
                            <input type="text" name="fiscal_code" id="fiscal_code" class="form-control" value="{{old('fiscal_code')}}" placeholder="{{__('athletes.Fiscal code')}}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="expiry_medical_certificate_at"><strong>{{__('athletes.Date medical certificate')}}</strong></label>
                            <input type="date" name="expiry_medical_certificate_at" id="expiry_medical_certificate_at" class="form-control" value="{{old('expiry_medical_certificate_at')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="phone"><strong>{{__('athletes.Phone')}}</strong></label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone')}}" placeholder="{{__('athletes.Phone')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email"><strong>{{__('athletes.Email')}}</strong></label>
                            <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="{{__('athletes.Email')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="address"><strong>{{__('athletes.Address')}}</strong></label>
                            <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}" placeholder="{{__('athletes.Address')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="municipality"><strong>{{__('athletes.Municipality')}}</strong></label>
                            <input type="text" name="municipality" id="municipality" class="form-control" value="{{old('municipality')}}" placeholder="{{__('athletes.Municipality')}}">
                        </div>
                        <div class="form-group col-4">
                            {{--TODO: Inserire la lista delle province italiane--}}
                            <label for="province"><strong>{{__('athletes.Province')}}</strong></label>
                            <input type="text" name="province" id="province" class="form-control" value="{{old('province')}}" placeholder="{{__('athletes.Province')}}">
                        </div>
                        <div class="form-group col-4">
                            {{--TODO: Inserire la lista delle nazioni--}}
                            <label for="country"><strong>{{__('athletes.Country')}}</strong></label>
                            <input type="text" name="country" id="country" class="form-control" value="{{old('country')}}" placeholder="{{__('athletes.Country')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="begin_with_us_at"><strong>{{__('athletes.Begun with us')}}</strong></label>
                            <input type="date" name="begin_with_us_at" id="begin_with_us_at" class="form-control" value="{{old('begin_with_us_at')}}">
                        </div>
                        <div class="form-group col-3">
                            <label for="end_with_us_at"><strong>{{__('athletes.End with us')}}</strong></label>
                            <input type="date" name="end_with_us_at" id="end_with_us_at" class="form-control" value="{{old('end_with_us_at')}}">
                        </div>
                        <div class="form-group col-6">
                            <label for="society_come_from"><strong>{{__('athletes.Name of the society')}}</strong></label>
                            <input type="text" name="society_come_from" id="society_come_from" class="form-control" value="{{old('society_come_from')}}" placeholder="{{__('athletes.The name of the society')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-1">
                            <label for="is_active"><strong>{{__('athletes.Is active')}}</strong></label>
                            <input type="checkbox" name="is_active" id="is_active" class="form-control" checked>
                        </div>
                        <div class="form-group col-8">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div>
                    </div>

                    <a href="/athletes" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
