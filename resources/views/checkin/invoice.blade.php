@extends('layouts.admin.admin')
@section('title', 'Generate Invoice')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12 col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center" style="font-weight:800;font-size: 35px">Surkheti Gurbhakot Geust House</h1>
                    <h1 class="text-center" style="font-weight:800;font-size: 20px">Tokha -09,Milantole ,New Buspark,karhmandu</h1>
                    <h1 class="text-center" style="font-weight:800;font-size: 20px">9801810953 / 9848119053</h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid" width="150">
                        </div>

                        <div class="col-lg-6  align-self-center">

                            <div class="">
                                <div class="float-right">
                                    <h6 class="mb-1"><b>CheckIn Date :</b> {{ $checkin->checked_in }}</h6>
                                    <h6 class="mb-0"><b>CheckOut Date :</b> {{ $checkin->checked_out }}</h6>
                                    <input type="hidden" class="checkin_id" value="{{$checkin->id}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left mt-5">
                                <address class="font-13">
                                    <strong class="font-size-14">Billed To :</strong><br>
                                    <span> {{ $checkin->customer->first_name }} {{ $checkin->customer->middle_name }}
                                        {{ $checkin->customer->last_name }}</span><br>
                                    {{$checkin->customer->customer_province->province_name}},
                                    {{$checkin->customer->customer_district->district_name}}<br>
                                    {{$checkin->customer->customer_municipality->name}}<br>
                                    <span>{{$checkin->customer->mobile_no}}</span>
                                </address>
                            </div>
                            <div class="float-right text-right mt-5">
                                <address class="font-13">
                                    <strong class="font-size-14">Room Type:</strong> {{$checkin->roomtype->title}}<br>
                                    <strong class="font-size-14">Total Number of Rooms:</strong> {{ $checkin->total_no_rooms }}<br>
                                    <strong class="font-size-14">Room No :</strong> {{$checkin->room_no}}<br>
                                    <strong class="font-size-14">Total Number of Guest:</strong> {{$checkin->total_no_people}}<br>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>Charges</th>
                                            <th>Credit</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($checkin->bills) && $checkin->bills->isEmpty() == false)
                                            @foreach ($checkin->bills as $bill)
                                                <tr>
                                                    <th>{{$loop->index+1}}</th>
                                                    <td>{{$bill->date}}</td>
                                                    <td>{{$bill->title}}</td>
                                                    <td>{{$bill->quantity}}</td>
                                                    <td>{{$bill->rate}}</td>
                                                    <td>{{$bill->total}}</td>
                                                    <td></td>
                                                    <td>{{$bill->total}}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if(isset($checkin->initial_payment))
                                        <tr>
                                            <th></th>
                                            <td>{{$checkin->checked_in}}</td>
                                            <td>Initial Payment</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{$checkin->initial_payment}}</td>
                                            <td>-{{$checkin->initial_payment}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td colspan="6" class="border-0"></td>
                                            <td class="border-0 font-size-14"><b>Sub Total</b></td>
                                            <td  class="border-0 font-size-14"><b>Rs. {{$total_price}}</b></td>
                                        </tr>

                                        <tr class="bg-dark text-light">
                                            <th colspan="6" class="border-0"></th>
                                            <td class="border-0 font-size-14"><b>Total</b></td>
                                            <td class="border-0 font-size-14"><b>Rs. {{$total_price}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h5 class="mt-4">Terms And Condition :</h5>
                            <ul class="pl-3">
                                <li><small>To be paid by cheque or credit card or direct payment online.</small></li>
                                <li><small> If account is not paid within 7 days the credits details supplied as confirmation<br> of work undertaken will be charged the agreed quoted fee noted above.</small></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 align-self-end">
                            <div class="w-25 float-right">
                                <img src="assets/images/signature.png" alt="" class="img-fluid">
                                <p class="border-top">Signature</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 col-xl-4 ml-auto align-self-center">
                            <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                        </div>
                        <div class="col-lg-12 col-xl-4">
                            <div class="float-right d-print-none">
                                <button class="btn btn-primary btn-submitinvoice">Submit</button>
                                <a href="{{route('checkin.index')}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // $(document).ready(function() {
        //     $('.btn-submitinvoice').on('click',function() {

        //         window.print();
        //     })
        // });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-submitinvoice').on('click', function(e) {
                    control = this;
                    let checkin_id = $('.checkin_id').val();
                    e.preventDefault();
                    Swal.fire({
                        title: 'Do you really want to Generate Invoice?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Generate'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: `{{ route('checkin.publish_invoice') }}`,
                                type: 'POST',
                                data: {
                                    checkin_id: checkin_id,
                                },
                                success: function(response) {
                                    if(typeof(response) != "object"){
                                        response = JSON.parse(response);
                                    }
                                    Swal.fire(
                                        'Success',
                                        ''+response.message+'',
                                        'success'
                                    )
                                    location.href = '{{route('checkin.index')}}';

                                },
                                error: function(error) {
                                    if(typeof(error) != "object"){
                                        error = JSON.parse(response);
                                    }
                                    console.log(error);
                                    Swal.fire(
                                        'Error',
                                        ''+error.message+'',
                                        'error'
                                    )
                                }

                            });
                        } else {
                            Swal.fire(
                                'Cancelled!',
                                'Invoice is not Generated.',
                                'error'
                            )
                        }
                    })

            });

        });
    </script>
@endsection
