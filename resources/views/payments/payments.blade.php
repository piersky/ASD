@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="text-uppercase">{{__('payments.Payments')}}</h1>
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
                @elseif(session()->get('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 my-2">
                <a href="{{route('payments.create')}}" class="btn btn-primary text-uppercase">{{__('payments.Add new payment')}}</a>
                @if($payment_old ?? '')
                    <a href="{{route('payments.duplicate', ['id' => $payment_old])}}" class="btn btn-warning text-uppercase"><span class="fa fa-copy"></span></a>
                @endif
            </div>
            @if($payments ?? '')
                <div class="col-sm-5 my-2">
                    <form action="/payments/search" method="POST" role="search">
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
                    {{$payments->links()}}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($payments ?? '')
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-uppercase">{{__('payments.Date')}}</th>
                                <th class="text-uppercase">{{__('payments.Athlete')}}</th>
                                <th class="text-uppercase">{{__('payments.Amount')}}</th>
                                <th class="text-uppercase">{{__('payments.Period')}}</th>
                                <th class="text-uppercase">{{__('payments.Method')}}</th>
                                <th class="text-uppercase">{{__('payments.Note')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr id="tr-{{$payment->id}}">
                                <td onclick="location.href='/payments/{{$payment->id}}';">{{date('d/m/Y', strtotime($payment->payment_date))}}</td>
                                <td><a href="/athletes/{{$payment->athlete_id}}">{{$payment->lastname}} {{$payment->firstname}}</a></td>
                                <td onclick="location.href='/payments/{{$payment->id}}';"><div class="d-flex justify-content-center">@money($payment->amount)</div></td>
                                <td onclick="location.href='/payments/{{$payment->id}}';">{{__($payment->period)}}</td>
                                <td onclick="location.href='/payments/{{$payment->id}}';">{{__($payment->method)}}</td>
                                <td style="width: 10%" onclick="location.href='/payments/{{$payment->id}}';">{{$payment->note}}</td>
                                <td class="d-flex justify-content-end"><a href="/payments/{{$payment->id}}/edit" class="btn btn-light mr-1"><span class="fa fa-pencil-alt"></span></a>
                                    <a href="/athletes/{{$payment->athlete_id}}/payments" class="btn btn-warning"><span class="fa fa-euro"></span></a>
                                    <button type="button" class="btn btn-outline-danger" data-id="{{$payment->id}}" data-url="/payments/{{$payment->id}}"><span class="fa fa-trash"></span></button>
                                </td>
                            </tr>
                        @endforeach
                        @else
                            <tr><td><h2>{{__('payments.No payments yet.')}}</h2></td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @if($payments ?? '')
            <div class="row">
                <div class="col-sm-8">
                    <p></p>
                </div>
                <div class="col-sm-4 my-2">
                    {{$payments->links()}}
                </div>
            </div>
        @endif
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
                                console.log(resp);
                            }
                        }
                    });
                });
            });
        });
    </script>
@endsection
