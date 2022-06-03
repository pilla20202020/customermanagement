@extends('layouts.admin.admin')
@section('title', 'Surkheti Gurbhakot Geust House')


@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('content')
            <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Surkheti Gurbhakot Geust House</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-1">Hotel Summary</h4>
                                <div class="row p-3">
                                    <div class="col-md-3 p-2" style="border-left: 4px solid #44a2d2;">
                                        <span class="pl-2">{{$users_count}}</span>
                                        <h6 class="pl-2 pt-1">Total Users</h6>
                                    </div>
                                    <div class="col-md-3 p-2" style="border-left: 4px solid #f9bc0b;">
                                        <span class="pl-2">{{$customer_count}}</span>
                                        <h6 class="pl-2 pt-1">New Customer</h6>
                                    </div>
                                    <div class="col-md-3 p-2" style="border-left: 4px solid #0f068a;">
                                        <span class="pl-2">{{$checkins->count()}}</span>
                                        <h6 class="pl-2 pt-1">CheckIn   </h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="pb-3 mt-0">Latest Customers</h5>
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Recent Checked In</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $customer)
                                                <tr>
                                                    <td>{{$customer->first_name}} {{$customer->middle_name}} {{$customer->last_name}}</td>
                                                    <td>{{$customer->email}}</td>
                                                    <td>{{$customer->mobile_no}}</td>
                                                    {{-- <td>{{$customer->passport_expiry_date}}</td> --}}

                                                    <td>
                                                        {{$customer->checkin->pluck('checked_in')->last()}}

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4>Recent CheckIn</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b class="mb-0">Customer Name</b>
                                        </div>
                                        <div class="col-md-6">
                                            <b class="mb-0">Check In Date</b>
                                        </div>
                                    </div>
                                    <hr>
                                    @foreach ($checkins as $checkin)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <b class="mb-0">
                                                    {{ $checkin->customer->first_name }}
                                                </b>
                                            </div>
                                            <div class="col-md-6">
                                                <b class="mb-0">{{$checkin->checked_in}}</b>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



        <!-- End Page-content -->
    </div>
@endsection

@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                order: [ [0, 'desc'] ]
            });
        } );
    </script>
@endsection
