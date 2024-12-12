@extends('layouts.app')

@section('title', 'Designation')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card basic-data-table">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Designation List</h6>
                    <button type="button" id="addBtn" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addEditModal"> 
                        <iconify-icon icon="solar:add-circle-broken" class="text-xl"></iconify-icon> Add New
                      </button>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0 dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                                <th scope="col" class="text-start">SI</th>
                                <th scope="col">Department</th>
                                <th scope="col">Title</th>
                                <th scope="col" class="text-start">Description</th>
                                <th scope="col" class="text-start">Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($designations as $designation)
                                <tr>
                                    <td class="text-start">{{ ++$loop->index }}</td>
                                    <td>{{ $designation->department->name }}</td>
                                    <td>{{ $designation->name }}</td>
                                    <td class="text-start">{{ safe($designation->description) }}</td>
                                    <td class="text-start">
                                        {!! status($designation->status) !!}
                                    </td>
                                    <td class="text-end">                                        
                                        <a 
                                            href="javascript:void(0)" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#addEditModal"
                                            data-department="{{ $designation->department_id }}"
                                            data-name="{{ $designation->name }}"
                                            data-status="{{ $designation->status }}"
                                            data-description="{{ $designation->description }}"
                                            data-url="{{ route('designation.update', $designation) }}"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center editBtn">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center deleteData">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                        <form action="{{ route('designation.destroy', $designation) }}" method="post" id="deleteForm">
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

    @include('pages.designations.__addEditModal')
@endsection

@push('js')
    <script src="{{ asset('assets/js/page/designation.js') }}"></script>
@endpush