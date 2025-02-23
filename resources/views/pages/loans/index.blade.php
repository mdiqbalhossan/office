@extends('layouts.app')

@section('title', 'Loans')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card basic-data-table">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Loans List</h6>
                    <a href="{{ route('loans.create') }}"
                        class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:add-circle-broken" class="text-xl"></iconify-icon> Add New
                    </a>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0 dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                                <th scope="col" class="text-start">Loan ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Loan Amount</th>
                                <th scope="col">Remaining Balance</th>
                                <th scope="col">Interest Rate</th>
                                <th scope="col">Monthly Installment</th>
                                <th scope="col">Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td class="text-start">
                                        <a href="{{ route('loans.show', $loan) }}" class="text-primary-600">#{{ $loan->loan_id }}</a>
                                    </td>
                                    <td>{{ showDate($loan->application_date) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $loan->employee->photo ? asset('assets/images/employee/' . $loan->employee->photo) : asset('assets/images/placeholder.png') }}" alt=""
                                                class="flex-shrink-0 me-12 radius-8 w-40p h-40p">
                                            <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $loan->employee->full_name }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ showAmount($loan->amount) }}</td>
                                    <td>{{ showAmount($loan->remaining_balance) }}</td>
                                    <td>{{ $loan->interest_rate }}%</td>
                                    <td>{{ showAmount($loan->monthly_installment) }}</td>
                                    <td>
                                        <span class="bg-{{ $loan->status == 'active' ? 'success' : 'danger' }}-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">
                                            {{ ucfirst($loan->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('employee.show', $loan) }}"
                                            class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center viewBtn">
                                            <iconify-icon icon="mdi:eye"></iconify-icon>
                                        </a>
                                        <a href="{{ route('document.index', ['employee_id' => $loan->id]) }}"
                                            class="w-32-px h-32-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center documentBtn">
                                            <iconify-icon icon="mdi:file-document"></iconify-icon>
                                        </a>
                                        <a href="{{ route('employee.edit', $loan) }}"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center editBtn">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center deleteData" data-id="{{ $employee->id }}">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                        <form action="{{ route('employee.destroy', $loan) }}" method="post"
                                            id="deleteForm_{{ $employee->id }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Latest Performance End -->
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/page/designation.js') }}"></script>
@endpush
