@extends('layouts.app')

@section('title', 'Add Employee')

@push('plugin')
    <link href="{{ asset('assets/css/lib/select2.min.css') }}" rel="stylesheet">    
@endpush

@section('content')
    <form action="{{ route('employee.store') }}" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Personal Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <label class="form-label">Employee Photo</label>
                                <!-- Upload Image Start -->
                                <div class="mb-24 mt-16">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                            <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                <iconify-icon icon="heroicons-outline:camera" class="icon"></iconify-icon>
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">First Name {!! required_sign() !!}</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name {!! required_sign() !!}</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Father Name</label>
                                <input type="text" name="father_name" class="form-control" placeholder="Enter Father Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mother Name</label>
                                <input type="text" name="mother_name" class="form-control" placeholder="Enter Mother Name">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Date of Birth {!! required_sign() !!}</label>
                                <input type="date" name="dob" class="form-control dateTime" placeholder="Enter Date of Birth">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Phone {!! required_sign() !!}</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter phone">
                            </div>
                            <div class="col-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter City">
                            </div>
                            <div class="col-6">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" placeholder="Enter State">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Zip</label>
                                <input type="text" name="zip" class="form-control" placeholder="Enter Zip">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Country</label>
                                <select class="form-select js-example-basic-single" name="country">
                                    <option value="">Select Country</option>
                                    @foreach (countries() as $country)
                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" class="form-control" rows="4" cols="50" placeholder="Write remarks..."></textarea>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Personal Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">                            
                            <div class="col-md-6">
                                <label class="form-label">Employee Id {!! required_sign() !!}</label>
                                <input type="text" name="employee_id" class="form-control" placeholder="Enter Employee ID">
                            </div>                            
                            <div class="col-6">
                                <label class="form-label">Department</label>
                                <select class="form-select js-example-basic-single" name="country">
                                    <option value="">Select Country</option>
                                    @foreach (countries() as $country)
                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Designation</label>
                                <select class="form-select js-example-basic-single" name="country">
                                    <option value="">Select Country</option>
                                    @foreach (countries() as $country)
                                        <option value="{{ $country['name'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" class="form-control" rows="4" cols="50" placeholder="Write remarks..."></textarea>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/lib/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/employee.js') }}"></script>
@endpush