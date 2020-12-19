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
<div class="container">
    <img src="{{asset('logo.png')}}" style="width: 150px;" class="mx-auto d-block">
    <h5 class="text-uppercase text-center">{{$group_name}}</h5>
    <div class="table-responsive">
        <table class="table table-striped mx-auto w-auto">
            <thead class="thead-dark">
            <tr>
                <th style="width: 10%" scope="col" class="text-uppercase"><small>{{__('ID')}}</small></th>
                <th style="width: 20%" scope="col" class="text-uppercase"><small>{{__('athletes.Name')}}</small></th>
                <th style="width: 20%" scope="col" class="text-uppercase"><small>{{__('athletes.Surname')}}</small></th>
                <th style="width: 10%" scope="col" class="text-uppercase"><small>{{__('athletes.Municipality of birth')}}</small></th>
                <th style="width: 10%" scope="col" class="text-uppercase"><small>{{__('athletes.Date of birth')}}</small></th>
                <th style="width: 10%" scope="col" class="text-uppercase"><small>{{__('athletes.Email')}}</small></th>
                <th style="width: 10%" scope="col" class="text-uppercase"><small>{{__('athletes.Address')}}</small></th>
                <th style="width: 10%" scope="col" class="text-uppercase"><small>{{__('athletes.Phone')}}</small></th>
            </tr>
            </thead>
            <tbody>
            @foreach($groupcomponents as $athlete)
                <tr class="small">
                    <td>{{$athlete->athlete_id}}</td>
                    <td>{{$athlete->lastname}}</td>
                    <td>{{$athlete->firstname}}</td>
                    <td>{{$athlete->birth_municipality}}</td>
                    <td>{{$athlete->date_of_birth}}</td>
                    <td>{{$athlete->email}}</td>
                    <td>{{$athlete->address}}</td>
                    <td>{{$athlete->phone}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
