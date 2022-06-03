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
                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">First Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ old('first_name', isset($customer->first_name) ? $customer->first_name : '') }}" required>
                                @error('first_name')
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Middle Name</label>
                                <input class="form-control" type="text" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name', isset($customer->middle_name) ? $customer->middle_name : '') }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Last Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="last_name" placeholder="Last Name" required value="{{ old('last_name', isset($customer->last_name) ? $customer->last_name : '') }}">
                                @error('last_name')
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email" class="col-form-label pt-0">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="your@email.com" value="{{ old('email', isset($customer->email) ? $customer->email : '') }}">
                                @error('email')
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="phone_no" class="col-form-label pt-0">Mobile No.<span class="text-danger">*</span></label>
                                <div class="">
                                    <input type="number" class="form-control" required name="mobile_no"
                                        placeholder="Mobile Number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ old('mobile_no', isset($customer->mobile_no) ? $customer->mobile_no : '') }}">
                                    @error('mobile_no')
                                        <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="phone_no" class="col-form-label pt-0">Mobile No. (Alternate)</label>
                                <div class="">
                                    <input type="number" class="form-control"
                                        name="alternate_mobile_no" placeholder="Mobile Number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" value="{{ old('alternate_mobile_no', isset($customer->alternate_mobile_no) ? $customer->alternate_mobile_no : '') }}">

                                    @error('alternate_mobile_no')
                                        <span class="text-danger">{{ $errors->first('alternate_mobile_no') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-sm-6">-->
                        <!--    <div class="form-group">-->
                        <!--        <label for="dob" class="col-form-label pt-0">Date of Birth</label>-->
                        <!--        <input type="date" class="form-control" name="dob" value="{{ old('dob', isset($customer->dob) ? $customer->dob : '') }}">-->
                        <!--        @error('dob')-->
                        <!--            <span class="text-danger">{{ $errors->first('dob') }}</span>-->
                        <!--        @enderror-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>

                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="father_name" class="col-form-label pt-0">Father's Name</label>
                                <div class="">
                                    <input type="text" class="form-control" name="father_name"
                                        placeholder="Father's Name" value="{{ old('father_name', isset($customer->father_name) ? $customer->father_name : '') }}">
                                    @error('father_name')
                                        <span class="text-danger">{{ $errors->first('father_name') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="mother_name" class="col-form-label pt-0">Mother's Name</label>
                                <div class="">
                                    <input type="text" class="form-control" name="mother_name"
                                        placeholder="Mother's Name" value="{{ old('mother_name', isset($customer->mother_name) ? $customer->mother_name : '') }}">
                                    @error('mother_name')
                                        <span class="text-danger">{{ $errors->first('mother_name') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="marital_status" class="col-form-label pt-0">Marital Status</label>
                                <select name="marital_status" id="marital_status" class="form-control">
                                    <option value="#" disabled selected>Select Marital Status</option>
                                    <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }} @if(isset($customer) && $customer->marital_status == "Single" ) selected @endif>Single</option>
                                    <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }} @if(isset($customer) && $customer->marital_status == "Married" ) selected @endif>Married</option>
                                    <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }} @if(isset($customer) && $customer->marital_status == "Divorced" ) selected @endif>Divorced</option>
                                    <option value="Widowed" {{ old('marital_status') == 'Widowed' ? 'selected' : '' }} @if(isset($customer) && $customer->marital_status == "Widowed" ) selected @endif>Widowed</option>
                                    <option value="Not Mention" {{ old('marital_status') == 'Not Mention' ? 'selected' : '' }} @if(isset($customer) && $customer->marital_status == "Not Mention" ) selected @endif>Prefer not to mention</option>
                                </select>
                                @error('marital_status')
                                    <span class="text-danger">{{ $errors->first('marital_status') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row spouse-name" @if(old('spouse_name')) style="display: block;"  @endif @if(isset($customer) && isset($customer->spouse_name) ) style="display: block;" @else style="display: none;"  @endif>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="spouse_name" class="col-form-label pt-0">Spouse's Name</label>
                                <div class="">
                                    <input type="text" class="form-control" name="spouse_name"
                                        placeholder="Spouse's Name" value="{{ old('spouse_name', isset($customer->spouse_name) ? $customer->spouse_name : '') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <h6>Gender</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}  @if(isset($customer) && $customer->gender == "male" ) checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}  @if(isset($customer) && $customer->gender == "female" ) checked @endif>
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="other" {{ old('gender') == 'other' ? 'checked' : '' }} @if(isset($customer) && $customer->gender == "other" ) checked @endif>
                                    <label class="form-check-label" for="inlineRadio3">Other</label>
                                </div>
                                @error('gender')
                                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-sm-4">
                            <div class="form-group">
                                <label for="blood-group" class="col-form-label pt-0">Blood Group </label>
                                <input type="text" class="form-control" name="blood_group" value="{{ old('blood_group', isset($customer->blood_group) ? $customer->blood_group : '') }}">
                            </div>
                        </div> --}}

                    </div>


                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="nationality" class="col-form-label pt-0">Nationality<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nationality" value="{{ old('nationality', isset($customer->nationality) ? $customer->nationality : '') }}" required>
                                @error('nationality')
                                    <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="nationality" class="col-form-label pt-0">Citizenship No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="citizenship" value="{{ old('nationality', isset($customer->citizenship) ? $customer->citizenship : '') }}" required>
                                @error('citizenship')
                                    <span class="text-danger">{{ $errors->first('citizenship') }}</span>
                                @enderror
                            </div>
                        </div>
                        <!--<div class="col-sm-3">-->
                        <!--    <div class="form-group">-->
                        <!--        <label for="issue_date" class="col-form-label pt-0">Citizenship Issue Date </label>-->
                        <!--        <input type="date" class="form-control" name="citizenship_issue_date"  value="{{ old('citizenship_issue_date', isset($customer->citizenship_issue_date) ? $customer->citizenship_issue_date : '') }}">-->
                        <!--        @error('citizenship_issue_date')-->
                        <!--            <span class="text-danger">{{ $errors->first('citizenship_issue_date') }}</span>-->
                        <!--        @enderror-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="districts" class="col-form-label pt-0">Citizenship Issue District</label>
                                    <select data-placeholder="Select District"
                                        class="select2 tail-select form-control district_class" id="district_id"
                                        name="citizenship_issue_district_id" >
                                        <option value="" selected disabled>Select Citizenship Issuing District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" @if(old('citizenship_issue_district_id') == $district->id) selected @endif @if(isset($customer) && ($customer->citizenship_issue_district_id == $district->id)) selected @endif >
                                                {{ ucfirst($district->district_name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('citizenship_issue_district_id')
                                        <span class="text-danger">{{ $errors->first('citizenship_issue_district_id') }}</span>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="province" class="col-form-label pt-0">Select Province/State <span class="text-danger">*</span></label>
                                <div class="">
                                    <select data-placeholder="Select Province"
                                        class="select2 tail-select form-control state_class" id="perm_province_id_dropdown"
                                        name="province_id" required>
                                        <option value="" selected disabled >Select Province</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}" @if(old('province_id') == $province->id) selected @endif @if(isset($customer) && ($customer->province_id == $province->id)) selected @endif>{{ ucfirst($province->province_name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('province_id')
                                        <span class="text-danger">{{ $errors->first('province_id') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="districts" class="col-form-label pt-0">Select District <span class="text-danger">*</span></label>
                                <div class="">
                                    <select data-placeholder="Select District"
                                        class="select2 tail-select form-control district_class" id="perm_district_id_dropdown"
                                        name="district_id" required>
                                        <option value="" selected disabled>Select District</option>
                                        @if(isset($customer) && $customer->district_id)
                                            <option value="{{$customer->customer_district->id }}" selected>{{$customer->customer_district->district_name }}</option>
                                        @elseif(old('district_id'))
                                            <option value="{{old('district_id')}}" selected>{{old('district_id')}}</option>
                                        @endif
                                    </select>
                                    @error('district_id')
                                        <span class="text-danger">{{ $errors->first('district_id') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="municipality" class="col-form-label pt-0">Select Metro/Sub-Metro/Municipality/VDC <span class="text-danger">*</span></label>
                                <div class="">
                                    <select data-placeholder="Select Municipality"
                                        class="select2 tail-select form-control municipality_class" id="perm_municipality_id_dropdown"
                                        name="municipality_id" required>
                                        <option value="" selected disabled>Select Metro/Sub-Metro/Municipality/VDC</option>
                                        @if(isset($customer) && $customer->municipality_id)
                                            <option value="{{$customer->municipality_id }}" selected>{{$customer->customer_municipality->name }}</option>
                                        @elseif(old('municipality_id'))
                                            <option value="{{old('municipality_id')}}" selected>{{old('municipality_id')}}</option>
                                        @endif
                                    </select>
                                    @error('municipality_id')
                                        <span class="text-danger">{{ $errors->first('municipality_id') }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="ward_no" class="col-form-label pt-0">Ward No.</label>
                                <input type="number" class="form-control" name="ward_no" placeholder="Ward" value="{{ old('ward_no', isset($customer->ward_no) ? $customer->ward_no : '') }}">
                                @error('ward_no')
                                    <span class="text-danger">{{ $errors->first('ward_no') }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="village_name" class="col-form-label pt-0">Village/Town/City</label>
                                <input type="text" class="form-control" name="village_name" value="{{ old('village_name', isset($customer->village_name) ? $customer->village_name : '') }}">
                                @error('village_name')
                                    <span class="text-danger">{{ $errors->first('village_name') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer" class="col-form-label pt-0">Upload Photo </label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @enderror
                            </div>
                        </div>
                        @if(isset($customer) && !empty($customer->image))
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <img src="{{ asset($customer->image_path)}}" alt="" height="100px">
                                </div>
                            </div>
                        @endif

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="customer" class="col-form-label pt-0">Upload Citizenship Image </label>
                                <input type="file" class="form-control" name="citizenship_image" accept="image/*">
                                @error('citizenship_image')
                                    <span class="text-danger">{{ $errors->first('citizenship_image') }}</span>
                                @enderror
                            </div>
                        </div>

                        @if(isset($customer) && !empty($customer->citizenship_image))
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <img src="{{ asset($customer->citizen_path)}}" alt="" height="100px">
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('customer.index') }}">
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
