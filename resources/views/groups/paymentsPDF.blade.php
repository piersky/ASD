<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'A.S.A.') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        @page {margin: 10px 10px 10px 10px;}
        body {font-size: 10px;}
        .column_h {width: 5%}
    </style>
</head>
<body>
    <img src="{{asset('logo.png')}}" style="width: 150px; padding-left: 500px;">
    <h5 class="text-uppercase text-center">{{$group_name}}</h5>
    <div class="table-responsive">
        <table class="table table-striped mx-auto w-auto">
            <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-uppercase column_h"><small>{{__('Athlete')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('Enrollment')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('1st_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('2nd_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('3rd_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('4th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('5th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('6th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('7th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('8th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('9th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('10th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('11th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('12th_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('1ex_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('2ex_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('3ex_fee')}}</small></th>
                <th scope="col" class="text-uppercase column_h"><small>{{__('4ex_fee')}}</small></th>
                <th style="width: 10%" scope="col" class="text-uppercase">{{__('Total')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($athletes as $athlete)
                <tr class="small">
                    <td class="border-dark" style="border: 1px solid black">{{$athlete->lastname}} {{$athlete->firstname}}</td>
                    @foreach($athlete->period_payments as $period_payment)
                        @if($period_payment['amount']!=0)
                            @switch($period_payment['method'])
                                @case('CASH')
                                @php $class = "alert-success"; @endphp
                                @break
                                @case('BANK WIRE')
                                @php $class = "alert-warning"; @endphp
                                @break
                                @case('CHECK')
                                @php $class = "alert-primary"; @endphp
                                @break
                                @case('POS')
                                @php $class = "alert-secondary"; @endphp
                                @break
                                @case('OTHER')
                                @php $class = ""; @endphp
                                @break
                            @endswitch
                        @else
                            @php $class="alert-danger"; @endphp
                        @endif
                        <td class="{{$class}}" style="border: 1px solid black">
                            <div class="d-flex justify-content-end">
                                @if($period_payment['amount']>0)
                                    @money($period_payment['amount'])
                                @endif
                            </div>
                            <div class="d-flex justify-content-end">
                                @if($period_payment['amount']>0)
                                    {{date('d/m/Y', strtotime($period_payment['date']))}}
                                @endif
                            </div>
                        </td>
                    @endforeach
                    <td style="border: 1px solid black"><div class="d-flex justify-content-end">@money($athlete->total)</div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
