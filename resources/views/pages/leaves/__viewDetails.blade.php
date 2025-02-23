<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content radius-16 bg-base">
            <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
                <h1 class="modal-title fs-5" id="modal_title">Leave Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <div class="row">
                    <table class="table table-bordered">                        
                        <tbody>
                            <tr>
                                <td>Employee ID</td>
                                <td id="employee_id_v"></td>
                            </tr>
                            <tr>
                                <td>Employee Name</td>
                                <td id="employee_name_v"></td>
                            </tr>
                            
                            <tr>
                                <td>Leave Type</td>
                                <td id="leave_type_v"></td>
                            </tr>
                            <tr>
                                <td>Leave Duration</td>
                                <td id="leave_duration_v"></td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td id="start_date_v"></td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td id="end_date_v"></td>
                            </tr>
                            <tr>
                                <td>Total Days</td>
                                <td id="total_days_v"></td>
                            </tr>
                            <tr>
                                <td>Reason</td>
                                <td id="reason_v"></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td id="status_v"></td>
                            </tr>
                            <tr>
                                <td>Approved By</td>
                                <td id="approve_by"></td>
                            </tr>
                            <tr>
                                <td>Approved At</td>
                                <td id="approve_at"></td>
                            </tr>
                            <tr>
                                <td>Rejection At</td>
                                <td id="rejection_at"></td>
                            </tr>
                            <tr>
                                <td>Rejection Reason</td>
                                <td id="rejection_reason"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex align-items-center justify-content-between gap-3 mt-24">
                        <a href="javascript:void(0);" id="rejectBtn"
                            class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-40 py-11 radius-8">
                            Reject
                        </a>
                        <a href="javascript:void(0);" id="approveBtn"
                            class="btn btn-primary border border-primary-600 text-md px-24 py-12 radius-8">
                            Approve
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
