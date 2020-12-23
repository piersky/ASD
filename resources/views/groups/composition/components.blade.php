@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="text-uppercase">{{$group->name}}</h1>
            </div>
            @if(session()->has('message'))
                @component('components.alert-info')
                    {{session()->get('message')}}
                @endcomponent
            @endif
            <div class="col-sm-6">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 my-3">
                <a href="{{route('groups.composition.add', ['id' => $group->id])}}" class="btn btn-primary text-uppercase">{{__('group_compositions.Add component to group')}}</a>
            </div>
            <div class="col-sm-5">
                <p></p>
            </div>
            <div class="col-sm-1 my-3">
                <a href="/groups/{{$group->id}}/pdf" class="btn btn-danger mr-1 d-flex align-content-end">PDF</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if(count($groupcompositions)>0)
                        <thead class="thead-dark">
                        <tr>
                            <th class="text-uppercase">{{__('group_compositions.Name')}}</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupcompositions as $groupcomponent)
                            <tr id="tr-{{$groupcomponent->id}}">
                                <td><a href="/athletes/{{$groupcomponent->athlete_id}}">{{$groupcomponent->lastname}} {{$groupcomponent->firstname}}</a></td>
                                <td class="d-flex justify-content-end">
                                    <a href="/athletes/{{$groupcomponent->athlete_id}}/payments" class="btn btn-warning mr-1"><span class="fa fa-euro"></span></a>
                                    <button type="button" class="btn btn-danger delete" data-id="{{$groupcomponent->id}}" data-url="/groups/component/{{$groupcomponent->id}}"><span class="fa fa-trash"></span></button>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr><td><h2>{{__('group_compositions.No athletes yet.')}}</h2></td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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

            $('.btn.btn-danger.delete').on('click', function (evt) {
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
