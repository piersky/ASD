@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('Settings')}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th class="text-left text-uppercase">{{__('Key')}}</th>
                            <th class="text-center text-uppercase">{{__('Value')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($keys as $key)
                            <tr>
                                <td class="text-left text-uppercase">{{$key->key}}</td>
                                <td class="text-center" >{{$key->value}}</td>
                                <td class="d-flex justify-content-end">
                                    <a href="/settings/{{$key->key}}/edit" class="btn btn-outline-dark mr-1"><span class="fa fa-pencil-alt"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
