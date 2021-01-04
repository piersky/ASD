<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'A.S.A.') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        @page {margin: 10px 10px 10px 10px;}
        body {font-size: 10px;}
    </style>
</head>
<body>
    <img src="{{asset('logo.png')}}" style="width: 150px; padding-left: 500px;">
    <h5 class="text-uppercase text-center">{{$group_name}}</h5>
    <div class="table-responsive">
        <table class="table table-striped mx-auto w-auto">
            <thead class="thead-dark">
            <tr>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('Athlete')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('Enrollment')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('1st_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('2nd_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('3rd_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('4th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('5th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('6th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('7th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('8th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('9th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('10th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('11th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase"><small>{{__('12th_fee')}}</small></th>
                <th style="width: 7%" scope="col" class="text-uppercase">{{__('Total')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($athletes as $athlete)
                <tr class="small">
                    <td>{{$athlete->lastname}} {{$athlete->firstname}}</td>
                    @foreach($athlete->period_payments as $period_payment)
                        <td class="alert alert-{{$period_payment['amount']==0?"danger":"success"}}">
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
                    <td><div class="d-flex justify-content-end">@money($athlete->total)</div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
