@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('groups.New Group')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <form action="{{route('groups')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-10">
                            <label for="name">{{__('groups.Group name')}}</label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{old('name')}}" placeholder={{__('groups.Group name')}}>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="is_active">{{__('groups.Is active')}}</label>
                            <input type="checkbox" name="is_active" id="is_active" class="form-control" checked>
                        </div>
                    </div>
                    <a href="/groups" class="btn btn-danger">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
