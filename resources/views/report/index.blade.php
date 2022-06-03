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
                                <input type="date" class="form-control" name="from_date" required value="{{ old('from_date', isset($checkin->from_date) ? $checkin->from_date : '') }}">
                                @error('from_date')
                                    <span class="text-danger">{{ $errors->first('from_date') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="to_date" class="col-form-label pt-0">To Date</label>
                                <input type="date" class="form-control" name="to_date" required value="{{ old('to_date', isset($checkin->to_date) ? $checkin->to_date : '') }}">
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
                            <th>ID</th>
                            <th>S.No.</th>
                            <th>Customer Name</th>
                            <th>Check In Date</th>
                            <th>Check Out Date</th>
                            <th>Room No.</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('report.data') }}',
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print',
                //     // exportOptions: {
                //     //     columns: 'th:not(:last-child)'
                //     // }
                // ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Export Search Results',
                        className: 'btn btn-default',
                        exportOptions: {
                            columns: 'th:not(:last-child)'
                        }
                    }
                ],
                "columns": [
                    { "data": "id",  'visible': false },
                    { "data": "DT_RowIndex",  orderable: false, searchable: false },
                    { "data": "name" },
                    { "data": "checked_in" },
                    { "data": "checked_out" },
                    { "data": "room_no" },
                    { "data": "total_price" },
                    { "data": "actions", orderable: false, searchable: false },
                ],
                order: [ [0, 'desc'] ]
            });
        } );
    </script>
@endsection
