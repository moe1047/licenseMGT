@extends('vendor.backpack.base.layout')
@section("before_styles")
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/') }}/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/') }}/datepicker/datepicker3.css">

@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{$message}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Default box -->
            <a href="{{url('admin/dailyOperation')}}"><i class="fa fa-angle-double-left"></i> Back to all  <span class="text-lowercase">daily operations</span></a><br><br>
            {!! Form::open(['url' => 'admin/dailyOperation']) !!}

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add a new  daily Operation</h3>
                    </div>
                    <div class="box-body ">
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Date</label>
                                <input type="text" name="date"  value="{{\Carbon\Carbon::today()->format('d/m/Y')}}" class="form-control date">
                            </div>
                            <!-- select2 -->
                            <div class="form-group col-md-6">
                                <label>Town</label>
                                {!! Form::select('town_id', $towns, null, ['placeholder' => 'Select Town','class'=>'form-control select2']) !!}
                            </div>
                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            <!-- select -->
                            <div class="form-group col-md-6">

                                <label>Weather Forecast</label>
                                {!! Form::select('weather_forecast', ['kacsan' => 'Kacsan', 'dhexdhexaad' => 'Dhexdhexaad', 'degan' => 'Degan'], null, ['placeholder' => 'Select Forecast','class'=>'form-control select2']) !!}
                            </div>        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            <!-- html5 date input -->

                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            <!-- select2 -->
                            <div class="form-group col-md-12">
                                <label>Ship</label>
                                {!! Form::select('ship_id', $ships, null, ['placeholder' => 'Select Ship','class'=>'form-control select2']) !!}
                            </div>
                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            <!-- text input -->
                            <div class="form-group col-md-4">
                                <label>Days spent in the sea</label>
                                <input type="text" name="days_spent_in_the_sea" value="" class="form-control">
                            </div>
                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            <!-- text input -->
                            <div class="form-group col-md-4">
                                <label>Number of nets</label>
                                <input type="text" name="number_of_nets" value="" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Number of other Gears</label>
                                <input type="text" name="number_of_other_gears" value="" class="form-control">
                            </div>
                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            <!-- select2 -->
                            <div class="form-group col-md-6">
                                <label>locations</label>
                                {!! Form::select('locations[]', $locations, null, ['multiple'=>'true','class'=>'form-control select2']) !!}
                            </div>
                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            <!-- text input -->
                            <div class="form-group col-md-6">
                                <label>Production amount</label>
                                <input type="text" name="production_amount" value="" class="form-control">
                            </div>
                        </div>


                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- select2 -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Fish 1</label>
                                {!! Form::select('fish_id_1', $fishes, null, ['placeholder' => 'Select Fish 1','class'=>'form-control select2 ']) !!}
                            </div>

                            <div class="form-group col-md-6">
                                <label>Fish 2</label>
                                {!! Form::select('fish_id_2', $fishes, null, ['placeholder' => 'Select Fish 2','class'=>'form-control select2']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label>Amount</label>
                                <input type="text" name="amount_fish_1" value="" class="form-control" placeholder="Fish 1 ">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Amount</label>
                                <input type="text" name="amount_fish_2" value="" class="form-control" placeholder="Fish 2">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Fish 3</label>
                                {!! Form::select('fish_id_3', $fishes, null, ['placeholder' => 'Select Fish 3','class'=>'form-control select2']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                <label>Others</label>
                                <input type="text" name="" value="Others" disabled="0" class="form-control" placeholder="Others">
                            </div>

                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            <!-- text input -->
                            <div class="form-group col-md-6">
                                <label>Amount</label>
                                <input type="text" name="amount_fish_3" value="" class="form-control" placeholder="Fish 3">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Amount</label>
                                <input type="text" name="others_amount" value="" class="form-control" placeholder="Others">
                            </div>
                        </div>




                        <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <!-- textarea -->
                        <div class="form-group col-md-12">
                            <label>Note</label>
                            <textarea name="note" class="form-control" value=" "></textarea>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">

                        <input type="submit" value="Save" class="btn btn-success">
                    </div><!-- /.box-footer-->

                </div><!-- /.box -->
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section("after_scripts")

    <script src="{{ asset('vendor/adminlte/plugins/') }}/select2/select2.min.js"></script>
    <script src="{{ asset('vendor/adminlte/plugins/') }}/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();
        });
        $('.date').datepicker({
            format: "dd/mm/yyyy"
        });
    </script>


@stop