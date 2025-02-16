@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title d-flex justify-content-between align-items-center">
                Employee Details
                <a href="{{ route('employee.edit', $employee) }}"
                    class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                    <iconify-icon icon="lucide:edit" class="text-xl"></iconify-icon> Edit
                </a>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="border-bottom pb-2 mb-3">Personal Details</h6>
                    <p><strong>First Name:</strong> {{ $employee->first_name }}</p>
                    <p><strong>Last Name:</strong> {{ $employee->last_name }}</p>
                    <p><strong>Father Name:</strong> {{ $employee->father_name }}</p>
                    <p><strong>Mother Name:</strong> {{ $employee->mother_name }}</p>
                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                    <p><strong>Date of Birth:</strong> {{ $employee->date_of_birth }}</p>
                    <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                    <p><strong>Address:</strong> {{ $employee->address }}</p>
                    <p><strong>City:</strong> {{ $employee->city }}</p>
                    <p><strong>State:</strong> {{ $employee->state }}</p>
                    <p><strong>Zip:</strong> {{ $employee->zip }}</p>
                    <p><strong>Country:</strong> {{ $employee->country }}</p>
                    <p><strong>Remarks:</strong> {{ $employee->remarks }}</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="border-bottom pb-2 mb-3">Company Details</h6>
                            <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                            <p><strong>Department:</strong> {{ $employee->companyDetails->department->name }}</p>
                            <p><strong>Designation:</strong> {{ $employee->companyDetails->designation->name }}</p>
                            <p><strong>Salary Type:</strong> {{ $employee->companyDetails->salary_type }}</p>
                            <p><strong>Basic Salary:</strong> ${{ $employee->companyDetails->basic_salary }}</p>
                            <p><strong>Hourly Rate:</strong> ${{ $employee->companyDetails->hourly_rate }}</p>
                            <p><strong>Joining Date:</strong> {{ $employee->companyDetails->joining_date }}</p>
                            <p><strong>End Date:</strong> {{ $employee->companyDetails->end_date }}</p>
                        </div>
                        <div class="col-12">
                            <h6 class="border-bottom pb-2 mb-3">Bank Details</h6>
                            @if ($employee->bankDetails == null)
                                <p class="text-danger">Bank details not provided.</p>
                            @else
                                <p><strong>Bank Name:</strong> {{ $employee->bankDetails->bank_name }}</p>
                                <p><strong>Branch Name:</strong> {{ $employee->bankDetails->branch_name }}</p>
                                <p><strong>Account Name:</strong> {{ $employee->bankDetails->account_name }}</p>
                                <p><strong>Account Number:</strong> {{ $employee->bankDetails->account_number }}</p>
                                <p><strong>IBAN:</strong> {{ $employee->bankDetails->iban }}</p>
                                <p><strong>Swift Code:</strong> {{ $employee->bankDetails->swift_code }}</p>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="border-bottom pb-2 mb-3">Allowances</h6>
                    <ul class="list-group">
                        @foreach ($employee->extraDetails()->allowances()->get() as $allowance)
                            <li class="list-group-item">
                                <strong>{{ $allowance->name }}</strong> -
                                {{ allowancesCalculate($allowance->amount, $allowance->amount_type, $employee->companyDetails->basic_salary) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6 class="border-bottom pb-2 mb-3">Deductions</h6>
                    <ul class="list-group">
                        @foreach ($employee->extraDetails()->deductions()->get() as $deduction)
                            <li class="list-group-item">
                                <strong>{{ $deduction->name }}</strong> -
                                {{ deductionsCalculate($deduction->amount, $deduction->amount_type, $employee->companyDetails->basic_salary) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
