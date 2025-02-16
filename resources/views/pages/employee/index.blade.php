@extends('layouts.app')

@section('title', 'Employee')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card basic-data-table">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Employee List</h6>
                    <a href="{{ route('employee.create') }}"
                        class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:add-circle-broken" class="text-xl"></iconify-icon> Add New
                    </a>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0 dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                                <th scope="col" class="text-start">Employee ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Department</th>
                                <th scope="col" class="text-start">Designation</th>
                                <th scope="col" class="text-start">Salary</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="text-start">
                                        <a href="{{ route('employee.show', $employee) }}" class="text-primary-600">#{{ $employee->employee_id }}</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $employee->photo ? asset('assets/images/employee/' . $employee->photo) : asset('assets/images/placeholder.png') }}" alt=""
                                                class="flex-shrink-0 me-12 radius-8 w-40p h-40p">
                                            <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $employee->full_name }}</h6>
                                        </div>
                                    </td>
                                    <td>{{ $employee->companyDetails->department->name }}</td>
                                    <td class="text-start">{{ safe($employee->companyDetails->designation->name) }}</td>
                                    <td class="text-start">
                                        {{ showAmount($employee->companyDetails->salary) }} - {{ ucwords($employee->companyDetails->salary_type) }}
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('employee.show', $employee) }}"
                                            class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center viewBtn">
                                            <iconify-icon icon="mdi:eye"></iconify-icon>
                                        </a>
                                        <a href="{{ route('document.index', ['employee_id' => $employee->id]) }}"
                                            class="w-32-px h-32-px bg-warning-focus text-warning-main rounded-circle d-inline-flex align-items-center justify-content-center documentBtn">
                                            <iconify-icon icon="mdi:file-document"></iconify-icon>
                                        </a>
                                        <a href="{{ route('employee.edit', $employee) }}"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center editBtn">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center deleteData">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                        <form action="{{ route('employee.destroy', $employee) }}" method="post"
                                            id="deleteForm">
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
