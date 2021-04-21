@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('parents.New Parent')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('parents')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <label for="lastname"><strong>{{__('parents.Last Name')}}*</strong></label>
                            <input type="text" required name="lastname" id="lastname" class="form-control" value="{{old('lastname')}}" placeholder="{{__('parents.Last Name')}}">
                        </div>
                        <div class="form-group col-sm-5">
                            <label for="firstname"><strong>{{__('parents.First Name')}}*</strong></label>
                            <input type="text" required name="firstname" id="firstname" class="form-control" value="{{old('firstname')}}" placeholder="{{__('parents.First Name')}}">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="gender"><strong>{{__('parents.Gender')}}</strong></label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="F" selected>{{__('parents.Female')}}</option>
                                <option value="M">{{__('parents.Male')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="address"><strong>{{__('parents.Address')}}*</strong></label>
                            <input type="text" required name="address" id="address" class="form-control" value="{{old('address')}}" placeholder="{{__('parents.Address')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="postal_code"><strong>{{__('parents.Postal code')}}*</strong></label>
                            <input type="text" required name="postal_code" id="postal_code" class="form-control" value="{{old('postal_code')}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="municipality"><strong>{{__('parents.Municipality')}}*</strong></label>
                            <input type="text" required name="municipality" id="municipality" class="form-control" value="{{old('municipality')}}">
                        </div>
                        <div class="form-group col-sm-4">
                            {{--TODO: Inserire la lista delle province italiane--}}
                            <label for="province"><strong>{{__('parents.Province')}}*</strong></label>
                            <input type="text" required name="province" id="province" class="form-control" value="{{old('province')}}" placeholder="{{__('parents.Province')}}">
                        </div>
                        <div class="form-group col-sm-2">
                            {{--TODO: Inserire la lista delle nazioni--}}
                            <label for="country"><strong>{{__('parents.Country')}}*</strong></label>
                            <input type="text" required name="country" id="country" class="form-control" value="{{old('country')}}" placeholder="{{__('parents.Country')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="mobile"><strong>{{__('parents.Mobile')}}*</strong></label>
                            <input type="text" required name="mobile" id="mobile" class="form-control" value="{{old('mobile')}}" placeholder="{{__('parents.Mobile')}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="phone"><strong>{{__('parents.Phone')}}*</strong></label>
                            <input type="text" required name="phone" id="phone" class="form-control" value="{{old('phone')}}" placeholder="{{__('parents.Phone')}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="email"><strong>{{__('parents.Email')}}</strong></label>
                            <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="{{__('parents.Email')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="fiscal_code"><strong>{{__('parents.Fiscal code')}}</strong></label>
                            <input type="text" name="fiscal_code" id="fiscal_code" class="form-control" value="{{old('fiscal_code')}}" placeholder="{{__('parents.Fiscal code')}}">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="wants_tc"><strong>{{__('parents.Wants tax certificate')}}</strong></label>
                            <input type="checkbox" name="wants_tc" id="wants_tc" class="form-control" value="{{old('wants_tc')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="conjugality"><strong>{{__('parents.Conjugality')}}</strong></label>
                            <select id="conjugality" name="conjugality" class="form-control">
                                <option value="MARRIED" selected>{{__('parents.Married')}}</option>
                                <option value="SINGLE">{{__('parents.Single')}}</option>
                                <option value="DIVORCED">{{__('parents.Divorced')}}</option>
                                <option value="OTHER">{{__('parents.Other')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-2">
                            <label for="is_active"><strong>{{__('parents.Is active')}}</strong></label>
                            <input type="checkbox" name="is_active" id="is_active" class="form-control" checked>
                        </div>
                    </div>

                    <a href="/parents" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
