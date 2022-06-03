@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'CheckIn List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">CheckIn List</header>
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction" href="{{ route('checkin.create') }}">
                        <i class="md md-add"></i>
                        Add CheckIn
                    </a>
                </div>
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">

                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>S.No.</th>
                            <th>Customers</th>
                            <th>Checked In</th>
                            <th>Checked Out</th>
                            <th>Total No. of Rooms</th>
                            <th>Room No.</th>
                            <th>Room Type</th>
                            <th>Total No. of People</th>
                            <th>Initial Payment</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>S.No.</th>
                            <th>Customers</th>
                            <th>Checked In</th>
                            <th>Checked Out</th>
                            <th>Total No. of Rooms</th>
                            <th>Room No.</th>
                            <th>Room Type</th>
                            <th>Total Number of People</th>
                            <th>Initial Payment</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-mb">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">User Leave History</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('checkin.add_checkout')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-underline">

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input type="hidden" class="checkin_id" name="checkin_id">
                                                    <div class="form-group">
                                                        <label for="checked_out" class="col-form-label pt-0">Checked Out Date</label>
                                                        <input type="date" class="form-control" name="checked_out" min="{{date('Y-m-d')}}" required value="">
                                                        @error('checked_out')
                                                            <span class="text-danger">{{ $errors->first('checked_out') }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <hr>
                                            <div class="row mt-2 justify-content-center">
                                                <div class="form-group">
                                                    <div>
                                                        <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#datatable tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" style="width: 100%;" placeholder="Search ' + title + '" />');
            });
            var table = $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('checkin.data') }}',
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
                    { "data": "customer_id" },
                    { "data": "checked_in" },
                    { "data": "checked_out" },
                    { "data": "total_no_rooms" },
                    { "data": "room_no" },
                    { "data": "room_id" },
                    { "data": "total_no_people" },
                    { "data": "initial_payment" },
                    { "data": "actions", orderable: false, searchable: false },
                ],
                order: [ [0, 'desc'] ]
            });

            table.columns().every( function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });

        function approvedthis(id) {
            var checkin_id = JSON.parse(id);
            $('.checkin_id').val(checkin_id);
            $('.bs-example-modal-center').modal('show');

        }
    </script>


@endsection


