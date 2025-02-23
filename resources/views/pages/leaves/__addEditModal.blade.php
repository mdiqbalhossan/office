<div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="modal_title">Add New Leave</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('leaves.store') }}" method="POST" id="form">
                    @csrf
                    <div id="method_sec">
                    </div>
                    <div class="row">   
                        <div class="col-6 mb-20">                            
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Employee</label>
                            <select class="form-select js-example-basic-single" name="employee_id" id="employee_id">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->employee_id }} - {{ $employee->full_name }}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-20">                           
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Leave Type</label>
                            <select class="form-select js-example-basic-single" name="leave_type_id" id="leave_type_id">
                                <option value="">Select Type</option>
                                @foreach ($leaveTypes as $leaveType)
                                    <option value="{{ $leaveType->id }}">{{ $leaveType->name }}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-20">
                            <label for="duration" class="form-label fw-semibold text-primary-light text-sm mb-8">Duration</label>
                            <select class="form-control radius-8" name="duration" id="duration">
                                <option value="full_day">Full Day</option>
                                <option value="half_day">Half Day</option>
                            </select>
                        </div>
                        <div class="col-6 mb-20">
                            <label for="start_date" class="form-label fw-semibold text-primary-light text-sm mb-8">Start Date</label>
                            <input type="date" class="form-control dateTime radius-8" name="start_date" id="start_date">
                        </div>
                        <div class="col-6 mb-20">
                            <label for="end_date" class="form-label fw-semibold text-primary-light text-sm mb-8">End Date</label>
                            <input type="date" class="form-control dateTime radius-8" name="end_date" id="end_date">
                        </div>
                        <div class="col-6 mb-20">
                            <label for="total_days" class="form-label fw-semibold text-primary-light text-sm mb-8">Total Days</label>
                            <input type="text" class="form-control dateTime radius-8" name="total_days" id="total_days" readonly>
                        </div>
                        <div class="col-12 mb-20">
                            <label for="reason" class="form-label fw-semibold text-primary-light text-sm mb-8">Reason</label>
                            <textarea name="reason" id="reason" class="form-control radius-8" rows="4" placeholder="Enter reason..."></textarea>
                        </div>                        
                        <div class="d-flex align-items-center justify-content-center gap-3 mt-24">
                            <button type="reset" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8"> 
                                Reset
                            </button>
                            <button type="submit" id="submitBtn" class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8"> 
                                Save Change
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>