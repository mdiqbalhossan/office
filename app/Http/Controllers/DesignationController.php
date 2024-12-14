<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designations = Designation::latest()->get();
        $title = 'Designation';
        $subTitle = 'Designation List';
        $departments = Department::latest()->get();
        return view('pages.designations.index',compact('designations', 'title', 'subTitle', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'department' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        Designation::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'department_id' => $request->department,
        ]);

        return redirect()->back()->with('success', __('Designation created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
            'department' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $designation->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'department_id' => $request->department,
        ]);

        return redirect()->back()->with('success', __('Designation updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->back()->with('success', __('Designation deleted successfully'));
    }
}
