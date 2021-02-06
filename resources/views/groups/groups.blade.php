@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('groups.Groups')}}</h1>
            </div>
            @if(session()->has('message'))
                @component('components.alert-info')
                    {{session()->get('message')}}
                @endcomponent
            @endif
            <div class="col-sm-8">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 my-2">
                <a href="{{route('groups.creategroup')}}" class="btn btn-primary text-uppercase">{{__('groups.Add new group')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($groups ?? '')
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-uppercase">ID</th>
                                <th class="text-uppercase">{{__('groups.Group name')}}</th>
                                <th class="text-uppercase text-center">{{__('groups.Total components')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr id="tr-{{$group->id}}">
                                <td>{{$group->id}}</td>
                                <td class="text-uppercase" onclick="location.href='{{route('groups.composition.components', $group->id)}}';">{{$group->name}}</td>
                                <td class="text-center">{{$group->total}}</td>
                                <td class="d-flex justify-content-end">
                                    <a href="/groups/{{$group->id}}/pdf" class="btn btn-danger mr-1"><span class="fa fa-file-pdf-o"></span></a>
                                    <a href="{{route('groups.payments', $group->id)}}" class="btn btn-warning mr-1"><span class="fa fa-euro"></span></a>
                                    @can('isAdmin')
                                        <button type="button" class="btn btn-outline-danger" data-id="{{$group->id}}" data-url="/groups/{{$group->id}}"><span class="fa fa-trash"></span></button>
                                    @endcan
                            </tr>
                        @endforeach
                        @else
                            <tr><td><h2>{{__('groups.No group yet.')}}</h2></td></tr>
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Confirm')}}</h5>
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

            $('.btn.btn-outline-danger').on('click', function (evt) {
                evt.preventDefault();

                var id = $(this).data('id');
                var url = $(this).data('url');
                var tr = $('#tr-'+id);

                $('#deleteModal').modal('show');

                $('#btn-elimina').on('click', function () {
                    $.ajax({
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
                        }
                    });
                });
            });
        });
    </script>
@endsection
