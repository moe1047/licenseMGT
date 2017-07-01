@extends('vendor.backpack.base.layout')
@section("before_styles")
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/') }}/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/') }}/datepicker/datepicker3.css">

@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => 'admin/report/print','method'=>'get']) !!}

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">License Printing</h3>
                </div>
                <div class="box-body row">
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- html5 datetime input -->
                    <div class="form-group col-md-4">
                        <label>From</label>
                        <input type="text" name="from" value="" class="form-control date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>To</label>
                        <input type="text" name="to" value="" class="form-control date">

                    </div>
                    <div class="form-group col-md-4">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="renewed">Renewed</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                    <!-- text input -->
                    <div class="form-group col-md-12">
                        <label>License</label>
                        {!! Form::select('licenses[]', $licenses, null, ['multiple'=>'true','class'=>'form-control select2']) !!}
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
                <div class="box-body " id="table-wrapper">
                    <table class="table table-bordered datatable">
                        <thead>
                        <tr>
                            <th>License</th><th>Owner</th><th>Business Name</th><th>Renewed date</th><th>Expire Date</th><th>Print</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td><b>Total:</b></td><td>{{$total_renewals}}</td>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if(isset($renewals))
                            @foreach($renewals as $renewal)
                                <tr>
                                    <td>{{$renewal->license->serial}}</td><td>{{$renewal->license->owner}}</td><td>{{$renewal->license->business_name}}</td>
                                    <td>{{$renewal->date}}</td><td>{{$renewal->expire_date}}</td>
                                    <td><a href="{{url('admin/report/'.$renewal->id.'/print')}}" target="_blank" class="btn btn-primary btn-xs">Print</a></td>
                                </tr>
                            @endforeach

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
        var table=$(".datatable").DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, 1, 2, 5 ]
                    }
                },
                'colvis'
            ]
        });
        table.buttons().container()
                .appendTo( '#table_wrapper' );
    </script>


@stop