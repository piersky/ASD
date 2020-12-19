@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('group_compositions.Add to')}} "{{$group->name}}"</h1>
            </div>
            @if(session()->has('message'))
                @component('components.alert-info')
                    {{session()->get('message')}}
                @endcomponent
            @endif
            <div class="col-sm-8 offset-sm-2">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <form action="{{route('groups.composition', ['id' => $group->id])}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-9">
                            <label for="athlete_id"><strong>{{__('group_compositions.Athlete')}}</strong></label>
                            <select id="athlete_id" name="athlete_id" class="form-control">
                                @foreach($athletes as $athlete)
                                    <option value="{{$athlete->athlete_id}}">{{$athlete->lastname}} {{$athlete->firstname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <a href="/groups/{{$group->id}}/composition" class="btn btn-danger text-uppercase">{{__('Cancel')}}</a>
                    <button type="submit" class="btn btn-primary text-uppercase">{{__('Submit')}}</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-10">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if(count($groupcompositions)>0)
                            <tbody>
                            @foreach($groupcompositions as $groupcomponent)
                                <tr>
                                    <td>{{$groupcomponent->lastname}} {{$groupcomponent->firstname}}</td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
