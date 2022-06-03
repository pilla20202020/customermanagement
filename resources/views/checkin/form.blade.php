@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862') }}" />
@endsection
@csrf
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="districts" class="col-form-label pt-0">Customers <span class="text-danger">*</span></label>
                                    <select
                                        class="select2 tail-select form-control" id=""
                                        name="customer_id" required>
                                        <option value="" selected disabled>Select Customers</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" @if(old('customer_id') == $customer->id) selected @endif @if(isset($checkin) && ($checkin->customer_id == $customer->id)) selected @endif >
                                                {{ ucfirst($customer->first_name .' '.$customer->middle_name.' '.$customer->last_name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="checked_in" class="col-form-label pt-0">Checked In Date</label>
                                <input type="date" class="form-control" name="checked_in" min="{{date('Y-m-d')}}" required value="{{ old('checked_in', isset($checkin->checked_in) ? $checkin->checked_in : '') }}">
                                @error('checked_in')
                                    <span class="text-danger">{{ $errors->first('checked_in') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="districts" class="col-form-label pt-0">Select Room Types <span class="text-danger">*</span></label>
                                    <select
                                        class="select2 tail-select form-control" id="room_type"
                                        name="room_id" required>
                                        <option value="" selected disabled>Select Room Types</option>
                                        @foreach ($roomtypes as $roomtype)
                                            <option value="{{ $roomtype->id }}" @if(old('room_id') == $roomtype->id) selected @endif @if(isset($checkin) && ($checkin->room_id == $roomtype->id)) selected @endif >
                                                {{ ucfirst($roomtype->title) }}</option>
                                        @endforeach
                                    </select>
                                    @error('room_id')
                                        <span class="text-danger">{{ $errors->first('room_id') }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="price" class="col-form-label pt-0">Price of Room</label>
                                <input type="number" class="form-control roomprice" readonly name="price" value="{{ old('price', isset($checkin->roomtype->price) ? $checkin->roomtype->price : '') }}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="total_no_people" class="col-form-label pt-0">Total Number of Rooms</label>
                                <input type="number" class="form-control" name="total_no_rooms" required value="{{ old('total_no_rooms', isset($checkin->total_no_rooms) ? $checkin->total_no_rooms : '') }}">
                                @error('total_no_people')
                                    <span class="text-danger">{{ $errors->first('total_no_rooms') }}</span>
                                @enderror
                            </div>
                        </div>

                        
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="checked_in" class="col-form-label pt-0">Room No.</label>
                                <input type="text" class="form-control" name="room_no" required value="{{ old('room_no', isset($checkin->room_no) ? $checkin->room_no : '') }}">
                                @error('room_no')
                                    <span class="text-danger">{{ $errors->first('room_no') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="total_no_people" class="col-form-label pt-0">Total Number of People</label>
                                <input type="number" class="form-control" name="total_no_people" required value="{{ old('total_no_people', isset($checkin->total_no_people) ? $checkin->total_no_people : '') }}">
                                @error('total_no_people')
                                    <span class="text-danger">{{ $errors->first('total_no_people') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="expected_days" class="col-form-label pt-0">Expected Days</label>
                                <input type="number" class="form-control" name="expected_days" value="{{ old('expected_days', isset($checkin->expected_days) ? $checkin->expected_days : '') }}">
                                @error('expected_days')
                                    <span class="text-danger">{{ $errors->first('expected_days') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="initial_payment" class="col-form-label pt-0">Initial Payment</label>
                                <input type="number" class="form-control" name="initial_payment" value="{{ old('initial_payment', isset($checkin->initial_payment) ? $checkin->initial_payment : '') }}">
                                @error('initial_payment')
                                    <span class="text-danger">{{ $errors->first('initial_payment') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('checkin.index') }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@section('page-specific-scripts')
    <script src="{{ asset('resources/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                containerCssClass: function(e) {
                    return $(e).attr('required') ? 'required' : '';
                }
            });
        });
    </script>
@endsection
