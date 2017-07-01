@extends('vendor.backpack.base.layout')
@section("before_styles")
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/') }}/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/') }}/datepicker/datepicker3.css">

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => 'admin/report/license','method'=>'get']) !!}

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">License Report</h3>
                </div>
                <div class="box-body row">
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- html5 datetime input -->
                    <div class="form-group col-md-3">
                        <label>From</label>
                        <input type="text" name="from" value="" class="form-control date">
                    </div>
                    <div class="form-group col-md-3">
                        <label>To</label>
                        <input type="text" name="to" value="" class="form-control date">

                    </div>
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- text input -->
                    <div class="form-group col-md-3">
                        <label>Serial</label>
                        <input type="text" name="serial" value="" class="form-control">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Business Name</label>
                        <input type="text" name="business_name" value="" placeholder="" class="form-control some-class">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="establishment_year">Establishment Year</label>
                        <input type="number" name="establishment_year" id="establishment_year" value="" placeholder="" class="form-control some-class">
                    </div>
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- text input -->
                    <div class="form-group col-md-3">
                        <label>Operation Site</label>
                        <input type="text" name="operation_site" value="" placeholder="" class="form-control some-class">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Ownership</label>
                        <select name="ownership" class="form-control">
                            <option value="">All</option>
                            <option value="personal">personal</option>
                            <option  value="Partner">Partnership</option>
                            <option  value="corporation">Corporation</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Owner</label>
                        <input type="text" name="owner" value="" placeholder="" class="form-control some-class">
                    </div>
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- text input -->
                    <div class="form-group col-md-3">
                        <label>Owner Tell</label>
                        <input type="text" name="owner_tell_1" value="" placeholder="" class="form-control some-class">
                    </div>

                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- text input -->
                    <div class="form-group col-md-3">
                        <label>Contact Person</label>
                        <input type="text" name="contact_person" value="" placeholder="" class="form-control some-class">
                    </div>
                    <!-- text input -->
                    <div class="form-group col-md-3">
                        <label>Applicant Name</label>
                        <input type="text" name="applicant_name" value="" placeholder="" class="form-control some-class">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Business Type</label>
                        {!! Form::select('business_types[]', $business_types, null, ['multiple'=>'true','class'=>'form-control select2']) !!}
                    </div>

                </div>
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
                            <td>Registered</td><td>Serial</td><td>Owner</td><td>B.type</td><td>Applicant</td><td>Contact</td>
                            <td>Ownership</td><td>E.Year</td><td>Site</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($licenses))
                            <? //$total_fish_1=0;?>
                            @foreach($licenses as $license)

                                <tr>
                                    <td>{{$license->date}}</td><td>{{$license->serial}}</td><td>{{$license->owner}}</td>
                                    <td>
                                        @foreach($license->businessTypes as $businessType)
                                            {{$businessType->name}}<br>
                                        @endforeach
                                    </td>
                                    <td>{{$license->applicant_name}}</td>
                                    <td>{{$license->contact_name}}</td>
                                    <td>{{$license->ownership}}</td><td>{{$license->establishment_year}}</td><td>{{$license->site}}</td>

                                </tr>
                            @endforeach
                            <tr>
                                <td><b>Total License</b></td>
                                <td>{{$total_licenses}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
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
        $(document).ready(function() {
            $(".select2").select2();
        });
        $('.date').datepicker({
            format: "dd/mm/yyyy"
        });
    </script>


@stop