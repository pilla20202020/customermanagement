@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
@csrf
<div class="row">
    <div class="col-sm-9">
        <div class="card">
            <div class="card-underline">
                <div class="card-head">
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="districts" class="col-form-label pt-0">Customers <span class="text-danger">*</span></label>
                                    <select
                                        class="select2 tail-select form-control" id=""
                                        name="customer_id" required>
                                        <option value="" selected disabled>Select Customers</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" @if(old('customer_id') == $customer->id) selected @endif @if(isset($credit) && ($credit->customer_id == $customer->id)) selected @endif >
                                                {{ ucfirst($customer->first_name .' '.$customer->middle_name.' '.$customer->last_name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Price</label>
                                <input type="number" name="price" class="form-control" required  value="{{ old('price', isset($credit->price) ? $credit->price : '') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" >
            <div class="card-body">
                <div class="row mt-2 justify-content-center">
                    <div class="form-group">
                        <div>
                            <a class="btn btn-light waves-effect ml-1" href="{{ route('room.index') }}">
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


@section('page-specific-scripts')
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
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
