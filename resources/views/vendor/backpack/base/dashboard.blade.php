@extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
        {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Today Expirations</div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody><tr>
                            <th>License</th><th>Owner</th><th>Business Name</th><th>Renewed date</th><th>Expire Date</th>
                        </tr>
                        @if(isset($today_expirations) and !empty($today_expirations))
                            @foreach($today_expirations as $today_expiration)
                                <tr>
                                    <td>{{$today_expiration["serial"]}}</td><td>{{$today_expiration["owner"]}}</td><td>{{$today_expiration["business_name"]}}</td>
                                    <td>{{$today_expiration["registered_date"]}}</td><td>{{$today_expiration["expire_date"]}}</td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Next 15 days Expirations</div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody><tr>
                            <th>License</th><th>Owner</th><th>Business Name</th><th>Renewed date</th><th>Expire Date</th>
                        </tr>
                        @if(isset($fifteen_expirations) and !empty($fifteen_expirations))
                            @foreach($fifteen_expirations as $fifteen_expiration)
                                <tr>
                                    <td>{{$fifteen_expiration["serial"]}}</td><td>{{$fifteen_expiration["owner"]}}</td><td>{{$fifteen_expiration["business_name"]}}</td>
                                    <td>{{$fifteen_expiration["registered_date"]}}</td><td>{{$fifteen_expiration["expire_date"]}}</td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Total Expirations</div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody><tr>
                            <th>License</th><th>Owner</th><th>Business Name</th><th>Renewed date</th><th>Expire Date</th>
                        </tr>
                        @if(isset($total_expired) and !empty($total_expired))
                            @foreach($total_expired as $expired)
                                <tr>
                                    <td>{{$expired["serial"]}}</td><td>{{$expired["owner"]}}</td><td>{{$expired["business_name"]}}</td>
                                    <td>{{$expired["registered_date"]}}</td><td>{{$expired["expire_date"]}}</td>
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
