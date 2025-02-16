<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeBankDetails;
use App\Models\EmployeeCompanyDetails;
use App\Models\EmployeeExtraDetails;
use App\Traits\ImageUpload;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('companyDetails', 'bankDetails', 'extraDetails')->latest()->get();
        $title = 'Employees';
        $subTitle = 'Employees List';
        return view('pages.employee.index', compact('employees', 'title', 'subTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Employees';
        $subTitle = 'Add Employee';
        $departments = Department::latest()->get();
        $designations = Designation::latest()->get();
        $employee_id = Employee::generateEmployeeId();
        $route = route('employee.store');
        return view('pages.employee.addEdit', compact('title', 'subTitle', 'departments', 'employee_id', 'designations', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'employee_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'phone' => 'required|unique:employees,phone',
            'email' => 'email|unique:employees,email',
            'department' => 'required',
            'designation' => 'required',
            'salary_type' => 'required',
            'basic_salary' => 'required_if:salary_type,fixed',
            'hourly_rate' => 'required_if:salary_type,hourly',
            'full_day_absence_fine' => 'required',
            'half_day_absence_fine' => 'required',
            'yearly_leave_limit' => 'required',
            'monthly_leave_quota' => 'required',
            'late_attendance_fine' => 'required',
            'joining_date' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', $validate->errors());
        }

        DB::beginTransaction();

        try {
            if($request->hasFile('photo')){ 
                $photo = $this->imageUploadTrait($request->photo, null, 'employee', 2048);
            } else {
                $photo = null;
            }

            $employee = Employee::create([
                'employee_id' => $request->employee_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'date_of_birth' => $request->dob,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
                'remarks' => $request->remarks,
                'photo' => $photo,                
            ]);

            EmployeeCompanyDetails::create([
                'employee_id' => $employee->id,
                'department_id' => $request->department,
                'designation_id' => $request->designation,
                'salary_type' => $request->salary_type,
                'basic_salary' => $request->basic_salary ?? 0,
                'hourly_rate' => $request->hourly_rate ?? 0,
                'full_day_absence_fine' => $request->full_day_absence_fine,
                'half_day_absence_fine' => $request->half_day_absence_fine,
                'late_attendance_fine' => $request->late_attendance_fine,
                'yearly_leave_quota' => $request->yearly_leave_limit,
                'monthly_leave_quota' => $request->monthly_leave_quota,
                'joining_date' => $request->joining_date,
                'end_date' => $request->end_date,
            ]);

            if($request->bank_name != null && $request->branch_name != null && $request->account_name != null && $request->account_number != null){
                EmployeeBankDetails::create([
                    'employee_id' => $employee->id,
                    'bank_name' => $request->bank_name,
                    'branch_name' => $request->branch_name,
                    'account_name' => $request->account_name,
                    'account_number' => $request->account_number,
                    'iban' => $request->iban,
                    'swift_code' => $request->swift_code,
                ]);
            }            

            if ($request->has('allowance_name') && $request->allowance_name != null) {
                foreach ($request->allowance_name as $key => $name) {
                    EmployeeExtraDetails::create([
                        'employee_id' => $employee->id,
                        'type' => 'allowances',
                        'name' => $name,
                        'amount' => $request->allowance_amount[$key],
                        'amount_type' => $request->allowance_amount_type[$key],
                    ]);
                }
            }

            if ($request->has('deduction_name') && $request->deduction_name != null) {
                foreach ($request->deduction_name as $key => $name) {
                    EmployeeExtraDetails::create([
                        'employee_id' => $employee->id,
                        'type' => 'deductions',
                        'name' => $name,
                        'amount' => $request->deduction_amount[$key],
                        'amount_type' => $request->deduction_amount_type[$key],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Employee created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            FacadesLog::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $title = 'Employees';
        $subTitle = 'Employee Details';
        return view('pages.employee.details', compact('employee', 'title', 'subTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $title = 'Employees';
        $subTitle = 'Edit Employee';
        $departments = Department::latest()->get();
        $designations = Designation::latest()->get();
        $route = route('employee.update', $employee->id);

        return view('pages.employee.addEdit', compact('employee', 'title', 'subTitle', 'departments', 'designations', 'route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'phone' => 'required|unique:employees,phone,'.$employee->id,
            'email' => 'email|unique:employees,email,'.$employee->id,
            'department' => 'required',
            'designation' => 'required',
            'salary_type' => 'required',
            'basic_salary' => 'required_if:salary_type,fixed',
            'hourly_rate' => 'required_if:salary_type,hourly',
            'full_day_absence_fine' => 'required',
            'half_day_absence_fine' => 'required',
            'yearly_leave_limit' => 'required',
            'monthly_leave_quota' => 'required',
            'late_attendance_fine' => 'required',
            'joining_date' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        DB::beginTransaction();

        try {
            if($request->hasFile('photo')){ 
                $photo = $this->imageUploadTrait($request->photo, $employee->photo, 'employee', 2048);
            } else {
                $photo = $employee->photo;
            }

            $employee->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'date_of_birth' => $request->dob,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
                'remarks' => $request->remarks,
                'photo' => $photo,
            ]);

            $employee->companyDetails()->update([
                'department_id' => $request->department,
                'designation_id' => $request->designation,
                'salary_type' => $request->salary_type,
                'basic_salary' => $request->basic_salary ?? 0,
                'hourly_rate' => $request->hourly_rate ?? 0,
                'full_day_absence_fine' => $request->full_day_absence_fine,
                'half_day_absence_fine' => $request->half_day_absence_fine,
                'late_attendance_fine' => $request->late_attendance_fine,
                'yearly_leave_quota' => $request->yearly_leave_limit,
                'monthly_leave_quota' => $request->monthly_leave_quota,
                'joining_date' => $request->joining_date,
                'end_date' => $request->end_date,
            ]);

            if($request->bank_name != null && $request->branch_name != null && $request->account_name != null && $request->account_number != null){
                $employee->bankDetails()->update([
                    'bank_name' => $request->bank_name,
                    'branch_name' => $request->branch_name,
                    'account_name' => $request->account_name,
                    'account_number' => $request->account_number,
                    'iban' => $request->iban,
                    'swift_code' => $request->swift_code,
                ]);

            }            

            if ($request->has('allowance_name') && $request->allowance_name != null) {
                foreach ($request->allowance_name as $key => $name) {
                    if($employee->extraDetails->count() > 0){
                        $employee->extraDetails()->allowances()->updateOrCreate([
                            'employee_id' => $employee->id,
                            'type' => 'allowances',
                            'name' => $name,
                            'amount' => $request->allowance_amount[$key],
                            'amount_type' => $request->allowance_amount_type[$key],
                        ]);
                    }else{
                        EmployeeExtraDetails::create([
                            'employee_id' => $employee->id,
                            'type' => 'allowances',
                            'name' => $name,
                            'amount' => $request->allowance_amount[$key],
                            'amount_type' => $request->allowance_amount_type[$key],
                        ]);
                    }
                }
            }

            if ($request->has('deduction_name') && $request->deduction_name != null) {
                foreach ($request->deduction_name as $key => $name) {
                    if($employee->extraDetails->count() > 0){
                        $employee->extraDetails()->deductions()->updateOrCreate([
                            'employee_id' => $employee->id,
                            'type' => 'deductions',
                            'name' => $name,
                            'amount' => $request->deduction_amount[$key],
                            'amount_type' => $request->deduction_amount_type[$key],
                        ]);
                    }else{
                        EmployeeExtraDetails::create([
                            'employee_id' => $employee->id,
                            'type' => 'deductions',
                            'name' => $name,
                            'amount' => $request->deduction_amount[$key],
                            'amount_type' => $request->deduction_amount_type[$key],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            FacadesLog::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        DB::beginTransaction();

        try {
            $employee->delete();
            @unlink('assets/images/employee/'.$employee->photo);
            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            FacadesLog::error($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
