@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{$parent->lastname}} {{$parent->firstname}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <form action="{{route('parents.update', ['id' => $parent->id])}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <label for="lastname"><strong>{{__('parents.Last Name')}}*</strong></label>
                            <input type="text" required name="lastname" id="lastname" class="form-control" value="{{$parent->lastname}}">
                        </div>
                        <div class="form-group col-sm-5">
                            <label for="firstname"><strong>{{__('parents.First Name')}}*</strong></label>
                            <input type="text" required name="firstname" id="firstname" class="form-control" value="{{$parent->firstname}}">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="gender"><strong>{{__('parents.Gender')}}</strong></label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="F" {{$parent->gender=="F"?"selected":""}}>{{__('parents.Female')}}</option>
                                <option value="M" {{$parent->gender=="M"?"selected":""}}>{{__('parents.Male')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="address"><strong>{{__('parents.Address')}}*</strong></label>
                            <input type="text" required name="address" id="address" class="form-control" value="{{$parent->address}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="postal_code"><strong>{{__('parents.Postal code')}}*</strong></label>
                            <input type="text" required name="postal_code" id="postal_code" class="form-control" value="{{$parent->postal_code}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="municipality"><strong>{{__('parents.Municipality')}}*</strong></label>
                            <input type="text" required name="municipality" id="municipality" class="form-control" value="{{$parent->municipality}}">
                        </div>
                        <div class="form-group col-sm-4">
                            {{--TODO: Inserire la lista delle province italiane--}}
                            <label for="province"><strong>{{__('parents.Province')}}*</strong></label>
                            <input type="text" required name="province" id="province" class="form-control" value="{{$parent->province}}">
                        </div>
                        <div class="form-group col-sm-2">
                            {{--TODO: Inserire la lista delle nazioni--}}
                            <label for="country"><strong>{{__('parents.Country')}}*</strong></label>
                            <input type="text" required name="country" id="country" class="form-control" value="{{$parent->country}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="mobile"><strong>{{__('parents.Mobile')}}*</strong></label>
                            <input type="text" required name="mobile" id="mobile" class="form-control" value="{{$parent->mobile}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="phone"><strong>{{__('parents.Phone')}}*</strong></label>
                            <input type="text" required name="phone" id="phone" class="form-control" value="{{$parent->phone}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="email"><strong>{{__('parents.Email')}}</strong></label>
                            <input type="text" name="email" id="email" class="form-control" value="{{$parent->email}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="fiscal_code"><strong>{{__('parents.Fiscal code')}}</strong></label>
                            <input type="text" name="fiscal_code" id="fiscal_code" class="form-control" value="{{$parent->fiscal_code}}">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="wants_tc"><strong>{{__('parents.Wants tax certificate')}}</strong></label>
                            <input type="checkbox" name="wants_tc" id="wants_tc" class="form-control" {{$parent->wants_tax_certificate==1?"checked":""}}>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="conjugality"><strong>{{__('parents.Conjugality')}}</strong></label>
                            <select id="conjugality" name="conjugality" class="form-control">
                                <option value="MARRIED" {{$parent->conjugality==="MARRIED"?"selected":""}}>{{__('parents.Married')}}</option>
                                <option value="SINGLE" {{$parent->conjugality==="SINGLE"?"selected":""}}>{{__('parents.Single')}}</option>
                                <option value="DIVORCED" {{$parent->conjugality==="DIVORCED"?"selected":""}}>{{__('parents.Divorced')}}</option>
                                <option value="OTHER" {{$parent->conjugality==="OTHER"?"selected":""}}>{{__('parents.Other')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-2">
                            <label for="is_active"><strong>{{__('parents.Is active')}}</strong></label>
                            <input type="checkbox" name="is_active" id="is_active" class="form-control" {{$parent->is_active?"checked":""}}>
                        </div>
                    </div>

                    <a href="/parents" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
