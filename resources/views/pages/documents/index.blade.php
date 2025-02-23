@extends('layouts.app')

@section('title', 'Employee Document')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card basic-data-table">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Employee Documents</h6>
                    <button type="button" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addEditModal"> 
                        <iconify-icon icon="solar:add-circle-broken" class="text-xl"></iconify-icon> Add New
                      </button>
                </div>
                <div class="card-body">
                    <table class="table bordered-table mb-0 dataTable" data-page-length='10'>
                        <thead>
                            <tr>
                                <th scope="col" class="text-start">Employee ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Document</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeDocuments as $document)
                                <tr>
                                    <td class="text-start">
                                        <a href="{{ route('employee.show', $document->employee) }}" class="text-primary-600">#{{ $document->employee->employee_id }}</a>
                                    </td>                                    
                                    <td>{{ $document->name }}</td>
                                    <td>
                                        @if (in_array(pathinfo($document->file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                            <a href="{{ asset('assets/documents/employee/' . $document->file) }}" target="_blank">
                                                <img src="{{ asset('assets/documents/employee/' . $document->file) }}" class="w-40p" alt="Document Image">
                                            </a>
                                        @else
                                            <a href="{{ asset('assets/documents/employee/' . $document->file) }}" target="_blank">
                                                <img src="{{ asset('assets/images/pdf.png') }}" class="w-40p" alt="Document File">
                                            </a>
                                        @endif
                                    </td>
                                    <td class="text-end">                                        
                                        <a href="javascript:void(0)"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#addEditModal"
                                            data-name="{{ $document->name }}"
                                            data-url="{{ route('document.update', $document) }}" 
                                            data-file="{{ $document->file }}"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center editBtn">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center deleteData" 
                                            data-id="{{ $document->id }}">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                        <form action="{{ route('document.destroy', $document) }}" method="post" 
                                            id="deleteForm_{{ $document->id }}">
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

    @include('pages.documents.__addEditModal')
@endsection

@push('js')
    <script src="{{ asset('assets/js/page/document.js') }}"></script>
@endpush
