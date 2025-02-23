<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Leave Application';
        $subTitle = 'List of Leaves';
        $leaves = Leave::latest()->get();
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();
        return view('pages.leaves.index', compact('title', 'subTitle', 'leaves', 'employees', 'leaveTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'duration' => 'required|in:full_day,half_day',
            'start_date' => 'required|date',
            'end_date' => 'required_if:duration,==,half_day|date',
            'reason' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        Leave::create([
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'approved',
            'approved_by' => auth()->user()->id,
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Leave application submitted successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'duration' => 'required|in:full_day,half_day',
            'start_date' => 'required|date',
            'end_date' => 'required_if:duration,==,half_day|date',
            'reason' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $leave->update([
            'employee_id' => $request->employee_id,
            'leave_type_id' => $request->leave_type_id,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
        ]);

        return redirect()->back()->with('success', 'Leave application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        return redirect()->back()->with('success', 'Leave application deleted successfully.');
    }


    /**
     * Status change
     */

    public function statusChange($id, $status)
    {
        $leave = Leave::findOrFail($id);
        if($status == 'approved'){
            $leave->update([
                'status' => $status,
                'approved_by' => auth()->user()->id,
                'approved_at' => now(),
            ]);
        }

        if($status == 'rejected'){
            $leave->update([
               'status' => $status,
                'rejection_date' => now(),
            ]);
        }
        
        return redirect()->back()->with('success', 'Leave application status changed successfully.');
    }
}
