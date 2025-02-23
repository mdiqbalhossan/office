<div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="modal_title">Add Loan Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form action="{{ route('loan-types.store') }}" method="POST" id="form">
                    @csrf
                    <div id="method_sec">
                    </div>
                    <div class="row">
                        <div class="col-6 mb-20">
                            <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Name</label>
                            <input type="text" class="form-control radius-8" name="name" id="name" placeholder="Enter Name">
                        </div>
                        <div class="col-6 mb-20">
                            <label for="interest_rate" class="form-label fw-semibold text-primary-light text-sm mb-8">Interest Rate (%)</label>
                            <input type="number" step="0.01" class="form-control radius-8" name="interest_rate" id="interest_rate" placeholder="Enter Interest Rate">
                        </div>
                        <div class="col-6 mb-20">
                            <label for="max_amount" class="form-label fw-semibold text-primary-light text-sm mb-8">Maximum Amount</label>
                            <input type="number" class="form-control radius-8" name="max_amount" id="max_amount" placeholder="Enter Maximum Amount">
                        </div>
                        <div class="col-6 mb-20">
                            <label for="min_amount" class="form-label fw-semibold text-primary-light text-sm mb-8">Minimum Amount</label>
                            <input type="number" class="form-control radius-8" name="min_amount" id="min_amount" placeholder="Enter Minimum Amount">
                        </div>
                        <div class="col-6 mb-20">
                            <label for="interest_type" class="form-label fw-semibold text-primary-light text-sm mb-8">Interest Type</label>
                            <select class="form-select radius-8" name="interest_type" id="interest_type">
                                <option value="">Select Interest Type</option>
                                <option value="fixed">Fixed</option>
                                <option value="declining">Reducing</option>
                            </select>
                        </div>
                        <div class="col-6 mb-20">
                            <label for="term" class="form-label fw-semibold text-primary-light text-sm mb-8">Term (Months)</label>
                            <input type="number" class="form-control radius-8" name="term" id="term" placeholder="Enter Loan Term">
                        </div>
                        <div class="col-6 mb-20">
                            <label for="status" class="form-label fw-semibold text-primary-light text-sm mb-8">Status</label>
                            <select class="form-select radius-8" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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