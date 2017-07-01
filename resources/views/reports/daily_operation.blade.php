@extends('vendor.backpack.base.layout')
@section("before_styles")
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/') }}/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/') }}/datepicker/datepicker3.css">

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => 'admin/report/dailyOperation','method'=>'get']) !!}

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Daily Operations Report</h3>
                </div>
                <div class="box-body ">
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>From</label>
                            <input type="text" name="from" value="" class="form-control date">
                        </div>
                        <div class="form-group col-md-3">
                            <label>To</label>
                            <input type="text" name="to" value="" class="form-control date">
                        </div>
                        <!-- select2 -->
                        <div class="form-group col-md-3">
                            <label>Town</label>
                            {!! Form::select('towns[]',  $towns, null, ['multiple'=>'true','class'=>'form-control select2']) !!}
                        </div>
                        <div class="form-group col-md-3">

                            <label>Weather Forecast</label>
                            {!! Form::select('weather_forecasts[]', ['kacsan' => 'Kacsan', 'dhexdhexaad' => 'Dhexdhexaad', 'degan' => 'Degan'], null, ['multiple'=>'true','class'=>'form-control select2']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- select -->
                               <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- html5 date input -->

                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- select2 -->
                        <div class="form-group col-md-4">
                            <label>Ship</label>
                            {!! Form::select('ships[]', $ships, null, ['multiple'=>'true','class'=>'form-control select2']) !!}
                        </div>
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- text input -->

                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- select2 -->
                        <div class="form-group col-md-4">
                            <label>locations</label>
                            {!! Form::select('locations[]', $locations, null, ['multiple'=>'true','class'=>'form-control select2']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fish</label>
                            {!! Form::select('fishes[]', $fishes, null, ['multiple'=>'true','class'=>'form-control select2 ']) !!}
                        </div>
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- text input -->
                    </div>



                </div><!-- /.box-body -->
                <div class="box-footer">
                    <input type="submit" value="Search" class="btn btn-success" name="search">
                </div><!-- /.box-footer-->

            </div><!-- /.box -->
            {!! Form::close() !!}
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Result</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>Date</td><td>Ship</td><td>Location</td><td>Town</td><td>Fishes</td>
                            <td>Pro.Amount</td><td>Forecast</td><td>Note</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($operations))
                            <? //$total_fish_1=0;?>
                            @foreach($operations as $operation)

                                <tr>
                                    <td>{{$operation->date}}</td><td>{{$operation->ship->name}}</td>
                                    <td>
                                        @foreach($operation->locations as $location)
                                            {{$location->name}}<br>
                                        @endforeach
                                    </td>
                                    <td>{{$operation->town->name}}</td>
                                    <td>{{$operation->fish1->name}}={{$operation->amount_fish_1}}<br>
                                        {{$operation->fish2->name}}={{$operation->amount_fish_2}}<br>
                                        {{$operation->fish3->name}}={{$operation->amount_fish_3}}<br>
                                        Others={{$operation->others_amount}}<br>
                                    </td>
                                    <td>{{$operation->production_amount}}</td><td>{{$operation->weather_forecast}}</td><td>{{$operation->note}}</td>

                                </tr>
                            @endforeach
                            <tr>
                                <td><b>Totals</b></td><td></td><td></td><td></td><td>{{$total_fishes}}</td><td>{{$production_amount}}</td><td></td>
                                <td></td>
                            </tr>
                        @endif

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->

            </div>


            <!-- /.box -->
        </div>

    </div>
@stop
@section("after_scripts")

    <script src="{{ asset('vendor/adminlte/plugins/') }}/select2/select2.min.js"></script>
    <script src="{{ asset('vendor/adminlte/plugins/') }}/datepicker/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $('.date').datepicker({
            format: "dd/mm/yyyy"
        });
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>


@stop