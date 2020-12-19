@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <h1 class="text-uppercase">{{__('groups.Edit Group')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <form action="{{ route('groups.update', ['id' => $group[0]->id]) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @method('PATCH')
                    <div class="row">
                        <div class="form-group col-sm-9">
                            <label for="name"><strong>{{__('groups.Group name')}}*</strong></label>
                            <input type="text" required name="name" id="name" class="form-control" value="{{old('name', $group[0]->name)}}" >
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="is_active"><stron>{{__('groups.Is active')}}</stron></label>
                            <input type="checkbox" name="is_active" id="is_active" class="form-control" {{$group[0]->is_active?"checked":""}}>
                        </div>
                    </div>
                    <a href="/groups" class="btn btn-danger text-uppercase">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
    </div>
@stop
