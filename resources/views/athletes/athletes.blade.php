@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-uppercase">{{__('athletes.Athletes')}}</h1>
            </div>
            @if(session()->has('message'))
                @component('components.alert-info')
                    {{session()->get('message')}}
                @endcomponent
            @endif
            <div class="col-sm-10">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 my-2">
                <a href="{{route('athletes.createathlete')}}" class="btn btn-primary text-uppercase">{{__('athletes.Add new athlete')}}</a>
            </div>
            @if($athletes ?? '')
                <div class="col-sm-5 my-2">
                    <form action="/athletes/search" method="POST" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" required class="form-control" name="q" placeholder="{{__('Search...')}}">
                            <button type="submit" class="btn btn-default">
                                <span class="fa fa-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4 my-2 justify-content-end">
                    {{$athletes->links()}}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($athletes ?? '')
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-left text-uppercase">{{__('athletes.Surname')}} {{__('athletes.Name')}}</th>
                                <th class="text-center text-uppercase">{{__('F/M')}}</th>
                                <th class="text-center text-uppercase">{{__('athletes.Date & place of birth')}}</th>
                                <th class="text-center text-uppercase">{{__('athletes.Phone')}}</th>
                                <th class="text-center text-uppercase">{{__('athletes.Email')}}</th>
                                <th class="text-center text-uppercase"><a href="/athletes/orderbygroup/{{$grouporder ?? ''}}">{{__('athletes.Group')}}</a></th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($athletes as $athlete)
                            <tr id="tr-{{$athlete->id}}" class="{{($athlete->is_active?"":'bg-secondary text-white-50')}}">
                                <td class="text-left text-uppercase" onclick="location.href='/athletes/{{$athlete->id}}';">{{$athlete->lastname}} {{$athlete->firstname}}</td>
                                <td class="text-center" onclick="location.href='/athletes/{{$athlete->id}}';">{{$athlete->gender=="F"?"F":"M"}}</td>
                                <td class="text-center" onclick="location.href='/athletes/{{$athlete->id}}';">{{date('d/m/Y', strtotime($athlete->date_of_birth))}} ({{$athlete->birth_province}})</td>
                                <td class="text-center" onclick="location.href='/athletes/{{$athlete->id}}';">{{$athlete->phone}}</td>
                                <td class="text-center" onclick="location.href='/athletes/{{$athlete->id}}';"><a href="mailto:{{$athlete->email}}">{{$athlete->email}}</a></td>
                                <td class="text-center" onclick="location.href='/athletes/{{$athlete->id}}';"><a href="/groups/{{$athlete->group_id}}/composition">{{$athlete->group_name}}</a></td>
                                <td class="d-flex justify-content-end">
                                    <a href="/athletes/{{$athlete->id}}/edit" class="btn btn-light mr-1"><span class="fa fa-pencil-alt"></span></a>
                                    <a href="/athletes/{{$athlete->id}}/payments" class="btn btn-warning mr-1"><span class="fa fa-euro"></span></a>
                                    <button type="button" class="btn btn-danger" data-id="{{$athlete->id}}" data-url="/athletes/{{$athlete->id}}"><span class="fa fa-trash"></span></button></td>
                            </tr>
                        @endforeach
                        @else
                            <tr><td><h2>{{__('athletes.No athletes yet.')}}</h2></td></tr>
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        @if($athletes ?? '')
            <div class="row">
                <div class="col-sm-8">
                    <p></p>
                </div>
                <div class="col-sm-4 my-2">
                    {{$athletes->links()}}
                </div>
            </div>
        @endif
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-uppercase" id="exampleModalLabel">{{__('Confirm')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('Please, click on DELETE to confirm the record cancellation.')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-danger text-uppercase" id ="btn-elimina">{{__('Delete')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('document').ready(function () {
            $('div.alert').fadeOut(5000);

            $('.btn.btn-danger').on('click', function (evt) {
                evt.preventDefault();

                var id = $(this).data('id');
                var url = $(this).data('url');
                var tr = $('#tr-'+id);

                $('#deleteModal').modal('show');

                $('#btn-elimina').on('click', function () {
                    var request = $.ajax({
                        url: url,
                        method: 'DELETE',
                        data: {
                            '_token': '{{csrf_token()}}'
                        },
                        complete: function (resp) {
                            if (resp.responseText == 1) {
                                tr.remove();
                                $('#deleteModal').modal('hide');
                            } else {
                                console.log('Problem contacting the server');
                            }
                        },
                        error: function(req, err) {
                            console.log("Errore " + err);
                        }
                    });

                    request.fail(function(jqXHR, textStatus) {
                        console.log( "Request failed: " + textStatus );
                    });
                });
            });
        });
    </script>
@endsection
