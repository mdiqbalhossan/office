@extends('layouts.app')

@section('title', 'Leave Application')

@push('plugin')
    <link href="{{ asset('assets/css/lib/select2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card basic-data-table">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Application List</h6>
                    <button type="button" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#addEditModal">
                        <iconify-icon icon="solar:add-circle-broken" class="text-xl"></iconify-icon> Add New
                    </button>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0 dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                                <th scope="col" class="text-start">SI</th>
                                <th scope="col" class="text-start">Employee ID</th>
                                <th scope="col" class="text-start">Leave Type</th>
                                <th scope="col" class="text-start">Leave Duration</th>
                                <th scope="col" class="text-start">Start Date</th>
                                <th scope="col" class="text-start">End Date</th>
                                <th scope="col" class="text-start">Total Day</th>
                                <th scope="col">Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                                <tr>
                                    <td class="text-start">{{ ++$loop->index }}</td>
                                    <td class="text-start">{{ $leave->employee->employee_id }}</td>
                                    <td class="text-start">{{ safe($leave->leaveType->name) }}</td>
                                    <td class="text-start">
                                        @if ($leave->duration == 'full_day')
                                            Full Day
                                        @else
                                            Half Day
                                        @endif
                                    </td>
                                    <td class="text-start">{{ showDate($leave->start_date) }}</td>
                                    <td class="text-start">{{ showDate($leave->end_date) }}</td>
                                    <td class="text-start">{{ safe($leave->total_days) }}</td>
                                    <td class="text-start">
                                        @if ($leave->status == 'pending')
                                            <span
                                                class="bg-warning-focus text-warning-main px-32 py-4 rounded-pill fw-medium text-sm">Pending</span>
                                        @elseif ($leave->status == 'approved')
                                            <span
                                                class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Approved</span>
                                        @else
                                            <span
                                                class="bg-danger-focus text-danger-main px-32 py-4 rounded-pill fw-medium text-sm">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
                                            data-id="{{ $leave->id }}"
                                            class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center viewBtn">
                                            <iconify-icon icon="mdi:eye-outline"></iconify-icon>
                                        </a>
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addEditModal"
                                            data-employee="{{ $leave->employee_id }}" data-leave_type="{{ $leave->leave_type_id }}"
                                            data-duration="{{ $leave->duration }}" data-start_date="{{ $leave->start_date }}"
                                            data-end_date="{{ $leave->end_date }}" data-reason="{{ $leave->reason }}"
                                            data-url="{{ route('leaves.update', $leave) }}" data-id="{{ $leave->id }}"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center editBtn">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center deleteData" data-id="{{ $leave->id }}">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                        <form action="{{ route('leaves.destroy', $leave) }}" method="post" 
                                            id="deleteForm_{{ $leave->id }}">
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

    @include('pages.leaves.__addEditModal')
    @include('pages.leaves.__viewDetails')
@endsection

@push('js')
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/lib/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/leaves.js') }}"></script>
@endpush
