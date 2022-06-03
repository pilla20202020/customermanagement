@extends('layouts.admin.admin')
@section('title', 'Add Bill')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12 col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Customer CheckIn Detail of <span class="text-danger">
                            ({{ $checkin->customer->first_name }} {{ $checkin->customer->middle_name }}
                            {{ $checkin->customer->last_name }})</span></h5>
                    <div class="row mt-5">
                        <div class="col-sm-6 form-group">
                            <label for="name" class="pt-0">Customer Name: </label>
                            <span> {{ $checkin->customer->first_name }} {{ $checkin->customer->middle_name }}
                                {{ $checkin->customer->last_name }}</span>
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="name" class="pt-0">Customer Contact Number: </label>
                            <span> {{ $checkin->customer->mobile_no }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">CheckIn: </label>
                            <span> {{ $checkin->checked_in }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">CheckOut: </label>
                            <span> {{ $checkin->checked_out }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Total Number of Rooms: </label>
                            <span> {{ $checkin->total_no_rooms }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Room Type: </label>
                            <span> {{ $checkin->roomtype->title }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Room Number: </label>
                            <span> {{ $checkin->room_no }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Total Number of People: </label>
                            <span> {{ $checkin->total_no_people }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Initial Payment: </label>
                            <span>Rs. {{ $checkin->initial_payment }}</span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label for="name" class="pt-0">Created by: </label>
                            <span>{{ $checkin->createdBy->name }}</span>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title">Add Bill Amount </h5>
                    <form action="{{route('checkin.store_generated_bill')}}" method="post">
                        @csrf
                        <input type="hidden" name="checkin_id" value="{{$checkin->id}}">
                        <div id="additernary_edu">
                            @if(isset($checkin->bills) && $checkin->bills->isEmpty() == false)
                                @foreach ($checkin->bills as $bill)
                                    <div class="form-group row d-flex align-items-end">.
                                        <div class="col-sm-2">
                                            <label class="control-label">Title</label>
                                            <input type="text" name="title[]" class="form-control" value="{{$bill->title}}" readonly>
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="control-label">Rate</label>
                                            <input type="number" name="rate[]" class="form-control" value="{{$bill->rate}}" readonly>
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="control-label">Quantity</label>
                                            <input type="number" name="quantity[]" class="form-control" value="{{$bill->quantity}}" readonly>
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="control-label">Date</label>
                                            <input type="date" name="date[]" class="form-control" value="{{$bill->date}}" readonly>
                                        </div>

                                        <div class="col-md-1" style="margin-top: 45px;">
                                            <a href="{{route('checkin.bill_delete',$bill->id)}}" class="btn btn-sm btn-danger mr-1" type="submit" value="">Remove row</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="form-group row d-flex align-items-end">.
                                <div class="col-sm-2">
                                    <label class="control-label">Title</label>
                                    <input type="text" name="title[]" class="form-control" required>
                                </div>

                                <div class="col-sm-2">
                                    <label class="control-label">Rate</label>
                                    <input type="number" name="rate[]" class="form-control" required>
                                </div>

                                <div class="col-sm-2">
                                    <label class="control-label">Quantity</label>
                                    <input type="number" name="quantity[]" class="form-control" required>
                                </div>

                                <div class="col-sm-3">
                                    <label class="control-label">Date</label>
                                    <input type="date" name="date[]" class="form-control" required>
                                </div>

                                <div class="col-md-1" style="margin-top: 45px;">
                                    <input id="additemrowedu" type="button" class="btn btn-sm btn-primary mr-1"
                                        value="Add Row">
                                </div>

                            </div>
                            <input type="hidden" id="tempedu" value="0" name="temp">
                        </div>
                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <a class="btn btn-light waves-effect ml-1" href="{{ route('checkin.index') }}">
                                        <i class="md md-arrow-back"></i>
                                        Back
                                    </a>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Save">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#additemrowedu', function() {
            var b = parseFloat($("#tempedu").val());
            b = b + 1;
            $("#tempedu").val(b);
            var temp = $("#tempedu").val();
            var tst = `<div class="form-group row d-flex align-items-end appended-row-edu">

                <div class="col-sm-2">
                    <label class="control-label">Title</label>
                    <input type="text" name="title[]" class="form-control" required>
                </div>
                <div class="col-sm-2">
                    <label class="control-label">Rate</label>
                    <input type="number" name="rate[]" class="form-control" required>
                </div>

                <div class="col-sm-2">
                    <label class="control-label">Quantity</label>
                    <input type="number" name="quantity[]" class="form-control" required>
                </div>

                <div class="col-sm-3">
                    <label class="control-label">Date</label>
                    <input type="date" name="date[]" class="form-control" required>
                </div>


                <div class="col-md-1" style="margin-top: 45px;">
                    <input class="removeitemrowedu btn btn-sm btn-danger mr-1" type="button" value="Remove row">
                </div>

            </div>`
            $('#additernary_edu').append(tst);
            selectRefresh();
        });

        $(document).on('click', '.removeitemrowedu', function() {
            $(this).closest('.appended-row-edu').remove();
        })

        function remove_product(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

        function remove_productforedit(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }
    </script>
@endsection
