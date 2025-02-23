@extends('layouts.app')

@section('title', 'Department')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card basic-data-table">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Department List</h6>
                    <button type="button" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addEditModal"> 
                        <iconify-icon icon="solar:add-circle-broken" class="text-xl"></iconify-icon> Add New
                      </button>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0 dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                                <th scope="col" class="text-start">SI</th>
                                <th scope="col">Name</th>
                                <th scope="col" class="text-start">Description</th>
                                <th scope="col" class="text-start">Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td class="text-start">{{ ++$loop->index }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td class="text-start">{{ safe($department->description) }}</td>
                                    <td class="text-start">
                                        {!! status($department->status) !!}
                                    </td>
                                    <td class="text-end">                                        
                                        <a 
                                            href="javascript:void(0)" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#addEditModal"
                                            data-name="{{ $department->name }}"
                                            data-status="{{ $department->status }}"
                                            data-description="{{ $department->description }}"
                                            data-url="{{ route('department.update', $department) }}"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center editBtn">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center deleteData" data-id="{{ $department->id }}">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                        <form action="{{ route('department.destroy', $department) }}" method="post" id="deleteForm_{{ $department->id }}">
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

    @include('pages.department.__addEditModal')
@endsection

@push('js')
    <script src="{{ asset('assets/js/page/department.js') }}"></script>
@endpush