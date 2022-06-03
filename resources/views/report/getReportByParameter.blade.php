@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Report List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Report Lists</header>

            </div>
            <div class="card mt-2 p-4">
                <form method="get" action="{{route('report.get_reports_by_parameter')}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="from_date" class="col-form-label pt-0">From Date</label>
                                <input type="date" class="form-control" name="from_date" required value="{{ old('from_date', isset($filters['from_date']) ? $filters['from_date'] : '') }}">
                                @error('from_date')
                                    <span class="text-danger">{{ $errors->first('from_date') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="to_date" class="col-form-label pt-0">To Date</label>
                                <input type="date" class="form-control" name="to_date" required value="{{ old('to_date', isset($filters['to_date']) ? $filters['to_date'] : '') }}">
                                @error('to_date')
                                    <span class="text-danger">{{ $errors->first('to_date') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2 tools">
                            <input type="submit" class="btn btn-primary ink-reaction mt-4">
                                <i class="md md-add"></i>
                            </a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Customer Name</th>
                            <th>Check In Date</th>
                            <th>Check Out Date</th>
                            <th>Room No.</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($reportservice))
                                @foreach ($reportservice as $report)

                                    <tr role="row" class="odd">
                                        <td>{{$loop->index + 1 }}</td>
                                        <td>{{$report->customer->first_name .' '.$report->customer->middle_name.' '.$report->customer->last_name }}</td>
                                        <td>{{$report->checked_in}}</td>
                                        <td>{{$report->checked_out}}</td>
                                        <td>{{$report->room_no}}</td>
                                        <td>Rs. {{$report->bills->sum('total') - $report->initial_payment}}</td>
                                        <td>
                                            <a href="{{route('checkin.show',$report->id)}}" target="__blank"><button type="button" class="btn btn-icon-toggle btn-sm" data-toggle="tooltip"  data-placement="top" data-original-title="View"><i class="far fa-eye"></i></button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <h6 class="pt-5">From <span class="title py-3 m-0 text-pink text-uppercase"> {{$filters['from_date']}}</span> to <span class="title py-3 m-0 text-pink text-uppercase"> {{$filters['to_date']}}</span> : Total of @if(isset($reportservice)) {{$reportservice->count()}} @endif customer visited the guest house. Total Bill Amount Generated is Rs. @if(isset($totalprice) && $totalprice != []) <span class="title py-3 m-0 text-pink text-uppercase">{{$totalprice}}</span> @endif</h6>
            </div>
        </div>
    </div>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });


    </script>
@endsection
