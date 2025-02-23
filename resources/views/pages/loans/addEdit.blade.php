@extends('layouts.app')

@section('title', $title)

@push('plugin')
    <link href="{{ asset('assets/css/lib/select2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <form action="{{ $route }}" method="POST" enctype="multipart/form-data" id="form">
        @csrf
        @if (isset($employee))
            @method('PUT')
        @endif
        <div class="row justify-content-center gy-4">
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
                                        <div
                                            class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                            <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg"
                                                hidden>
                                            <label for="imageUpload"
                                                class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                <iconify-icon icon="heroicons-outline:camera" class="icon"></iconify-icon>
                                            </label>
                                        </div>
                                        <div class="avatar-preview">
                                            @if (isset($employee) && $employee->photo != null)
                                                <div id="imagePreview"
                                                    style="background-image: url({{ asset('assets/images/employee/' . $employee->photo) }});">
                                                </div>
                                            @else
                                                <div id="imagePreview"></div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">First Name {!! required_sign() !!}</label>
                                <input type="text" name="first_name" class="form-control required"
                                    placeholder="Enter First Name"
                                    value="{{ old('first_name', $employee->first_name ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name {!! required_sign() !!}</label>
                                <input type="text" name="last_name" class="form-control required"
                                    placeholder="Enter Last Name"
                                    value="{{ old('last_name', $employee->last_name ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Father Name</label>
                                <input type="text" name="father_name" class="form-control"
                                    placeholder="Enter Father Name"
                                    value="{{ old('father_name', $employee->father_name ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mother Name</label>
                                <input type="text" name="mother_name" class="form-control"
                                    placeholder="Enter Mother Name"
                                    value="{{ old('mother_name', $employee->mother_name ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                    value="{{ old('email', $employee->email ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Date of Birth {!! required_sign() !!}</label>
                                <input type="date" name="dob" class="form-control dateTime required"
                                    placeholder="Enter Date of Birth"
                                    value="{{ old('dob', $employee->date_of_birth ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Phone {!! required_sign() !!}</label>
                                <input type="text" name="phone" class="form-control required" placeholder="Enter phone"
                                    value="{{ old('phone', $employee->phone ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                    value="{{ old('address', $employee->address ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter City"
                                    value="{{ old('city', $employee->city ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">State</label>
                                <input type="text" name="state" class="form-control" placeholder="Enter State"
                                    value="{{ old('state', $employee->state ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Zip</label>
                                <input type="text" name="zip" class="form-control" placeholder="Enter Zip"
                                    value="{{ old('zip', $employee->zip ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Country</label>
                                <select class="form-select js-example-basic-single" name="country">
                                    <option value="">Select Country</option>
                                    @foreach (countries() as $country)
                                        <option value="{{ $country['name'] }}"
                                            {{ old('country', $employee->country ?? '') == $country['name'] ? 'selected' : '' }}>
                                            {{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks" class="form-control" rows="4" cols="50" placeholder="Write remarks...">{{ old('remarks', $employee->remarks ?? '') }}</textarea>
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
                                <input type="text" name="employee_id" class="form-control required"
                                    placeholder="Enter Employee ID"
                                    value="{{ old('employee_id', $employee->employee_id ?? $employee_id) }}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Department {!! required_sign() !!}</label>
                                <select class="form-select js-example-basic-single required" name="department"
                                    id="department">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department', $employee->companyDetails->department_id ?? '') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Designation {!! required_sign() !!}</label>
                                <select class="form-select js-example-basic-single required" name="designation"
                                    id="designation">
                                    <option value="">Select Designation</option>
                                    @foreach ($designations as $designation)
                                        <option value="{{ $designation->id }}"
                                            {{ old('designation', $employee->companyDetails->designation_id ?? '') == $designation->id ? 'selected' : '' }}>
                                            {{ $designation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Salary Type {!! required_sign() !!}</label>
                                <select class="form-select required" name="salary_type">
                                    <option value="fixed"
                                        {{ old('salary_type', $employee->companyDetails->salary_type ?? '') == 'fixed' ? 'selected' : '' }}>
                                        Fixed</option>
                                    <option value="hourly"
                                        {{ old('salary_type', $employee->companyDetails->salary_type ?? '') == 'hourly' ? 'selected' : '' }}>
                                        Hourly</option>
                                </select>
                            </div>
                            <div class="col-6" id="basicSalary">
                                <label class="form-label">Basic Salary ($) {!! required_sign() !!}</label>
                                <input type="number" name="basic_salary" class="form-control required"
                                    placeholder="Enter Basic Salary"
                                    value="{{ old('basic_salary', $employee->companyDetails->basic_salary ?? '') }}">
                            </div>
                            <div class="col-6 d-none" id="hourlyRate">
                                <label class="form-label">Hourly Rate ($) {!! required_sign() !!}</label>
                                <input type="number" name="hourly_rate" class="form-control required"
                                    placeholder="Enter Hourly Rate"
                                    value="{{ old('hourly_rate', $employee->companyDetails->hourly_rate ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Full Day Absence Fine ($) {!! required_sign() !!}</label>
                                <input type="number" name="full_day_absence_fine" class="form-control required"
                                    placeholder="Enter Full Day Absence Fine"
                                    value="{{ old('full_day_absence_fine', $employee->companyDetails->full_day_absence_fine ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Half Day Absence Fine ($) {!! required_sign() !!}</label>
                                <input type="number" name="half_day_absence_fine" class="form-control required"
                                    placeholder="Enter Half Day Absence Fine"
                                    value="{{ old('half_day_absence_fine', $employee->companyDetails->half_day_absence_fine ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Late Attendance Fine ($) {!! required_sign() !!}</label>
                                <input type="number" name="late_attendance_fine" class="form-control required"
                                    placeholder="Enter Late Attendance Fine"
                                    value="{{ old('late_attendance_fine', $employee->companyDetails->late_attendance_fine ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Monthly Leave Quota {!! required_sign() !!}</label>
                                <input type="number" name="monthly_leave_quota" class="form-control required"
                                    placeholder="Enter Monthly Leave Quota"
                                    value="{{ old('monthly_leave_quota', $employee->companyDetails->monthly_leave_quota ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Yearly Leave Limit {!! required_sign() !!}</label>
                                <input type="number" name="yearly_leave_limit" class="form-control required"
                                    placeholder="Enter Yearly Leave Limit"
                                    value="{{ old('yearly_leave_limit', $employee->companyDetails->yearly_leave_quota ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Joining Date {!! required_sign() !!}</label>
                                <input type="date" name="joining_date" class="form-control dateTime required"
                                    placeholder="Enter Joining Date"
                                    value="{{ old('joining_date', $employee->companyDetails->joining_date ?? '') }}">
                            </div>
                            <div class="col-6">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control dateTime"
                                    placeholder="Enter End Date"
                                    value="{{ old('end_date', $employee->companyDetails->end_date ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Bank Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-12">
                                <label class="form-label">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control"
                                    placeholder="Enter Bank Name"
                                    value="{{ old('bank_name', $employee->bankDetails->bank_name ?? '') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Branch Name</label>
                                <input type="text" name="branch_name" class="form-control"
                                    placeholder="Enter Branch Name"
                                    value="{{ old('branch_name', $employee->bankDetails->branch_name ?? '') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Account Name</label>
                                <input type="text" name="account_name" class="form-control"
                                    placeholder="Enter Account Name"
                                    value="{{ old('account_name', $employee->bankDetails->account_name ?? '') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="account_number" class="form-control"
                                    placeholder="Enter Account Number"
                                    value="{{ old('account_number', $employee->bankDetails->account_number ?? '') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">IBAN</label>
                                <input type="text" name="iban" class="form-control" placeholder="Enter IBAN"
                                    value="{{ old('iban', $employee->bankDetails->iban ?? '') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Swift Code</label>
                                <input type="text" name="swift_code" class="form-control"
                                    placeholder="Enter Swift Code"
                                    value="{{ old('swift_code', $employee->bankDetails->swift_code ?? '') }}">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header w-100 d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0 text-success">Allowances</h6>
                        <button type="button" class="btn btn-outline-success-600 btn-sm" id="addAllowance">
                            <iconify-icon icon="ic:baseline-plus" class="text-xl"></iconify-icon>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Amount Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="allowanceBody">
                                @if (isset($employee) && $employee->extraDetails->count() > 0 && $employee->extraDetails()->allowances()->count() > 0)
                                    @foreach ($employee->extraDetails()->allowances()->get() as $allowance)
                                        <tr>
                                            <td><input type="text" name="allowance_name[]" class="form-control"
                                                    placeholder="Enter Name" value="{{ $allowance->name }}"></td>
                                            <td><input type="number" name="allowance_amount[]" class="form-control"
                                                    placeholder="Enter Amount" value="{{ $allowance->amount }}"></td>
                                            <td>
                                                <select name="allowance_amount_type[]" class="form-select">
                                                    <option value="fixed"
                                                        {{ $allowance->amount_type == 'fixed' ? 'selected' : '' }}>Fixed
                                                    </option>
                                                    <option value="percentage"
                                                        {{ $allowance->amount_type == 'percentage' ? 'selected' : '' }}>
                                                        Percentage</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-danger-600 btn-sm removeAllowance">
                                                    <iconify-icon icon="ic:baseline-delete"
                                                        class="text-xl"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td><input type="text" name="allowance_name[]" class="form-control"
                                                placeholder="Enter Name"></td>
                                        <td><input type="number" name="allowance_amount[]" class="form-control"
                                                placeholder="Enter Amount"></td>
                                        <td>
                                            <select name="allowance_amount_type[]" class="form-select">
                                                <option value="fixed">Fixed</option>
                                                <option value="percentage">Percentage</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-outline-danger-600 btn-sm removeAllowance">
                                                <iconify-icon icon="ic:baseline-delete" class="text-xl"></iconify-icon>
                                            </button>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header w-100 d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0 text-danger">Deductions</h6>
                        <button type="button" class="btn btn-outline-danger-600 btn-sm" id="addDeduction">
                            <iconify-icon icon="ic:baseline-plus" class="text-xl"></iconify-icon>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Amount Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="deductionBody">
                                @if (isset($employee) && $employee->extraDetails->count() > 0 && $employee->extraDetails()->deductions()->count() > 0)
                                    @foreach ($employee->extraDetails()->deductions()->get() as $deduction)
                                        <tr>
                                            <td><input type="text" name="deduction_name[]" class="form-control"
                                                    placeholder="Enter Name" value="{{ $deduction->name }}"></td>
                                            <td><input type="number" name="deduction_amount[]" class="form-control"
                                                    placeholder="Enter Amount" value="{{ $deduction->amount }}"></td>
                                            <td>
                                                <select name="deduction_amount_type[]" class="form-select">
                                                    <option value="fixed"
                                                        {{ $deduction->amount_type == 'fixed' ? 'selected' : '' }}>Fixed
                                                    </option>
                                                    <option value="percentage"
                                                        {{ $deduction->amount_type == 'percentage' ? 'selected' : '' }}>
                                                        Percentage</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-outline-danger-600 btn-sm removeDeduction">
                                                    <iconify-icon icon="ic:baseline-delete"
                                                        class="text-xl"></iconify-icon>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td><input type="text" name="deduction_name[]" class="form-control"
                                                placeholder="Enter Name"></td>
                                        <td><input type="number" name="deduction_amount[]" class="form-control"
                                                placeholder="Enter Amount"></td>
                                        <td>
                                            <select name="deduction_amount_type[]" class="form-select">
                                                <option value="fixed">Fixed</option>
                                                <option value="percentage">Percentage</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-outline-danger-600 btn-sm removeDeduction">
                                                <iconify-icon icon="ic:baseline-delete" class="text-xl"></iconify-icon>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-10 text-center">
                <button type="submit"
                    class="btn btn-outline-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                    <iconify-icon icon="mingcute:checkbox-line" class="text-xl"></iconify-icon> Save Changes
                </button>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/lib/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/employee.js') }}"></script>
@endpush
