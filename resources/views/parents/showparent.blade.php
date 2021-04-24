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
                    <div class="row">
                        <div class="form-group col-sm-5">
                            <label for="lastname"><strong>{{__('parents.Last Name')}}*</strong></label>
                            <input type="text" disabled name="lastname" id="lastname" class="form-control" value="{{$parent->lastname}}">
                        </div>
                        <div class="form-group col-sm-5">
                            <label for="firstname"><strong>{{__('parents.First Name')}}*</strong></label>
                            <input type="text" disabled name="firstname" id="firstname" class="form-control" value="{{$parent->firstname}}">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="gender"><strong>{{__('parents.Gender')}}</strong></label>
                            <input type="text" readonly name="gender" id="gender" class="form-control" value={{$parent->gender=="F"?__('parents.Female'):__('parents.Male')}}>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="address"><strong>{{__('parents.Address')}}*</strong></label>
                            <input type="text" disabled name="address" id="address" class="form-control" value="{{$parent->address}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="postal_code"><strong>{{__('parents.Postal code')}}*</strong></label>
                            <input type="text" disabled name="postal_code" id="postal_code" class="form-control" value="{{$parent->postal_code}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="municipality"><strong>{{__('parents.Municipality')}}*</strong></label>
                            <input type="text" disabled name="municipality" id="municipality" class="form-control" value="{{$parent->municipality}}">
                        </div>
                        <div class="form-group col-sm-4">
                            {{--TODO: Inserire la lista delle province italiane--}}
                            <label for="province"><strong>{{__('parents.Province')}}*</strong></label>
                            <input type="text" disabled name="province" id="province" class="form-control" value="{{$parent->province}}">
                        </div>
                        <div class="form-group col-sm-2">
                            {{--TODO: Inserire la lista delle nazioni--}}
                            <label for="country"><strong>{{__('parents.Country')}}*</strong></label>
                            <input type="text" disabled name="country" id="country" class="form-control" value="{{$parent->country}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="mobile"><strong>{{__('parents.Mobile')}}*</strong></label>
                            <input type="text" disabled name="mobile" id="mobile" class="form-control" value="{{$parent->mobile}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="phone"><strong>{{__('parents.Phone')}}*</strong></label>
                            <input type="text" disabled name="phone" id="phone" class="form-control" value="{{$parent->phone}}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="email"><strong>{{__('parents.Email')}}</strong></label>
                            <input type="text" disabled name="email" id="email" class="form-control" value="{{$parent->email}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="fiscal_code"><strong>{{__('parents.Fiscal code')}}</strong></label>
                            <input type="text" disabled name="fiscal_code" id="fiscal_code" class="form-control" value="{{$parent->fiscal_code}}">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="wants_tc"><strong>{{__('parents.Wants tax certificate')}}</strong></label>
                            <input onclick="return false;" type="checkbox" name="wants_tc" id="wants_tc" class="form-control" value="{{$parent->wants_tc}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="conjugality"><strong>{{__('parents.Conjugality')}}</strong></label>
                            @php $s = "" @endphp
                            @switch($parent->conjugality)
                                @case("MARRIED")
                                    @php $s = __('parents.Married') @endphp
                                @break
                                @case("SINGLE")
                                    @php $s = __('parents.Single') @endphp
                                @break
                                @case("DIVORCED")
                                    @php $s = __('parents.Divorced') @endphp
                                @break
                                @case("OTHER")
                                    @php $s = __('parents.Other') @endphp
                                @break
                            @endswitch
                            <input type="text" readonly name="gender" id="gender" class="form-control" value="{{$s}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-2">
                            <label for="is_active"><strong>{{__('parents.Is active')}}</strong></label>
                            <input onclick="return false;" type="checkbox" name="is_active" id="is_active" class="form-control" {{$parent->is_active==1?"checked":""}}>
                        </div>
                    </div>

                    <a href="/parents" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
