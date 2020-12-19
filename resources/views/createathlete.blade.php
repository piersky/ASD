@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">{{__('New Athlete')}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
{{--    @include('partials.inputerrors')--}}
            <form action="{{route('athletes')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="firstname">{{__('First Name')}}</label>
                        <input type="text" required name="firstname" id="firstname" class="form-control" value="{{old('firstname')}}" placeholder="Athlete first name">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">{{__('Last Name')}}</label>
                        <input type="text" required name="lastname" id="lastname" class="form-control" value="{{old('lastname')}}" placeholder="Athlete last name">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="">{{__('Date of birth')}}</label>
                        <input type="date" required name="date_of_birth" id="date_of_birth" class="form-control" value="{{old('date_of_birth')}}">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">{{__('Municipality of birth')}}</label>
                        <input type="text" required name="birth_municipality" id="birth_municipality" class="form-control" value="{{old('birth_municipality')}}" placeholder="Athlete municipality of birth">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">{{__('Province of birth')}}</label>
                        <input type="text" required name="birth_province" id="birth_province" class="form-control" value="{{old('birth_province')}}" placeholder="Athlete province of birth">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">{{__('Birth Country')}}</label>
                        <input type="text" name="birth_country" id="birth_country" class="form-control" value="{{old('birth_country')}}" placeholder="Country of birth">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="">{{__('Fiscal code')}}</label>
                        <input type="text" name="fiscal_code" id="fiscal_code" class="form-control" value="{{old('fiscal_code')}}" placeholder="Fiscal code">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="">{{__('Address')}}</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{old('address')}}" placeholder="Address">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="">{{__('Municipality')}}</label>
                        <input type="text" name="municipality" id="municipality" class="form-control" value="{{old('municipality')}}" placeholder="Municipality">
                    </div>
                    <div class="form-group col-4">
                        <label for="">{{__('Province')}}</label>
                        <input type="text" name="province" id="province" class="form-control" value="{{old('province')}}" placeholder="Province">
                    </div>
                    <div class="form-group col-4">
                        <label for="">{{__('Country')}}</label>
                        <input type="text" name="country" id="country" class="form-control" value="{{old('country')}}" placeholder="Country">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-1">
                        <label for="">{{__('Is active')}}</label>
                        <input type="checkbox" required name="is_active" id="is_active" class="form-control" checked>
                    </div>
                </div>
        {{--        @include('albums.partials.fileupload')--}}
                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
            </form>
        </div>
    </div>
@stop
