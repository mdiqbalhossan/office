<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Leave;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function getDesignations(Request $request)
    {
        $designations = Designation::where('department_id', $request->department_id)->get();
        return response()->json($designations);
    }

    public function getLeaves($id)
    {
        $leaves = Leave::with('employee', 'leaveType', 'approvedBy')
            ->where('employee_id', $id)
            ->first();

        if ($leaves) {
            $leaves->start_date = showDate($leaves->start_date);
            $leaves->end_date = showDate($leaves->end_date);
            $leaves->approved_at = showDate($leaves->approved_at);
            $leaves->rejection_date = showDate($leaves->rejection_date);
            if($leaves->status == 'pending') {
                $leaves->status = '<span class="bg-warning-focus text-warning-main px-32 py-4 rounded-pill fw-medium text-sm">Pending</span>';
            } elseif($leaves->status == 'approved') {
                $leaves->status = '<span class="bg-success-focus text-success-main px-32 py-4 rounded-pill fw-medium text-sm">Approved</span>';
            } elseif($leaves->status == 'rejected') {
                $leaves->status = '<span class="bg-danger-focus text-danger-main px-32 py-4 rounded-pill fw-medium text-sm">Rejected</span>';
            }
        }



        return response()->json($leaves);
    }

}
