@extends('layouts.admin.admin')
@section('title', 'View Customers')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12 col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Customer Detail of <span class="text-danger">
                            ({{ $customer->first_name }} {{ $customer->middle_name }}
                            {{ $customer->last_name }})</span></h5>
                    <div class="row mt-5">
                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Name: </label>
                            <span> {{ $customer->first_name }} {{ $customer->middle_name }}
                                {{ $customer->last_name }}</span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Email: </label>
                            <span> {{ $customer->email }}</span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Contact Number: </label>
                            <span> {{ $customer->mobile_no }}</span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Gender: </label>
                            <span> {{ ucfirst($customer->gender) }}</span>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Marital Status: </label>
                            <span> {{ ucfirst($customer->marital_status) }}</span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Date Of Birth: </label>
                            <span> {{ ucfirst($customer->dob) }}</span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Father Name: </label>
                            <span> {{ ucfirst($customer->father_name) }}</span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Mother Name: </label>
                            <span> {{ ucfirst($customer->mother_name) }}</span>
                        </div>

                        @if($customer->spouse_name)
                            <div class="col-sm-4 form-group">
                                <label for="name" class="pt-0">Spouse Name: </label>
                                <span> {{ ucfirst($customer->spouse_name) }}</span>
                            </div>
                        @endif

                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Identification Type: </label>
                            <span> {{ ucfirst($customer->identification_type) }}</span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Identification No: </label>
                            <span> {{ ucfirst($customer->identification_no) }}</span>
                        </div>


                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Province: </label>
                            <span> {{ ucfirst($customer->customer_province->province_name) }}</span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">District: </label>
                            <span> {{ ucfirst($customer->customer_district->district_name) }}</span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Municipality: </label>
                            <span> {{ ucfirst($customer->customer_municipality->name) }}</span>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="name" class="pt-0">Ward No.: </label>
                            <span> {{ ucfirst($customer->ward_no) }}</span>
                        </div>

                        @if(isset($customer) && !empty($customer->image))
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customer" class="col-form-label pt-0">Image: </label>
                                        <img src="{{ asset($customer->image_path)}}" alt="" height="100px">
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if(isset($customer) && !empty($customer->citizenship_image))
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="customer" class="col-form-label pt-0">Citizenship Image: </label>
                                        <img src="{{ asset($customer->citizen_path)}}" alt="" height="100px">
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>


                    <hr>

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

                <div class="col-sm-4">
                    <label class="control-label">Title</label>
                    <input type="text" name="title[]" class="form-control" required>
                </div>
                <div class="col-sm-3">
                    <label class="control-label">Price</label>
                    <input type="number" name="price[]" class="form-control" required>
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
