@extends('layouts.app')

@section('title', 'Loan Types')

@section('content')
    <div class="row">
        <div class="col-xxl-12">
            <div class="card basic-data-table">
                <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0">Loan Types</h6>
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
                                <th scope="col" class="text-start">Status</th>
                                <th scope="col" class="text-start">Minimum Amount</th>
                                <th scope="col" class="text-start">Maximum Amount</th>
                                <th scope="col" class="text-start">Interest Rate</th>
                                <th scope="col" class="text-start">Interest Type</th>
                                <th scope="col" class="text-start">Term</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loanTypes as $type)
                                <tr>
                                    <td class="text-start">{{ ++$loop->index }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td class="text-start">
                                        @if($type->status == 'active')
                                            <span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Active</span>
                                        @else
                                            <span class="bg-danger-focus text-danger-main px-32 py-4 rounded-pill fw-medium text-sm">Deactivate</span>
                                        @endif
                                    </td>
                                    <td class="text-start">{{ showAmount($type->min_amount) }}</td>
                                    <td class="text-start">{{ showAmount($type->max_amount) }}</td>
                                    <td class="text-start">{{ $type->interest_rate }}%</td>
                                    <td class="text-start">{{ safe(ucwords($type->interest_type)) }}</td>
                                    <td class="text-start">{{ safe($type->term) }}</td>
                                    
                                    <td class="text-end">                                        
                                        <a 
                                            href="javascript:void(0)" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#addEditModal"
                                            data-name="{{ $type->name }}"                                            
                                            data-interest_rate="{{ $type->interest_rate }}"
                                            data-max_amount="{{ $type->max_amount }}"
                                            data-min_amount="{{ $type->min_amount }}"
                                            data-interest_type="{{ $type->interest_type }}"
                                            data-term="{{ $type->term }}"
                                            data-status="{{ $type->status }}"
                                            data-id="{{ $type->id }}"
                                            data-url="{{ route('loan-types.update', $type) }}"
                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center editBtn">
                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center deleteData" 
                                            data-id="{{ $type->id }}">
                                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                        </a>
                                        <form action="{{ route('loan-types.destroy', $type) }}" method="post" id="deleteForm_{{ $type->id }}">
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

    @include('pages.loan_types.__addEditModal')
@endsection

@push('js')
    <script src="{{ asset('assets/js/page/loan_types.js') }}"></script>
@endpush