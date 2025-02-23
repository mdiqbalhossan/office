<?php

namespace App\Http\Controllers;

use App\Models\LoanType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Loan Types';
        $subTitle = 'All Loan Types';
        $loanTypes = LoanType::all();
        return view('pages.loan_types.index', compact('title', 'subTitle', 'loanTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'interest_rate' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0',
            'min_amount' => 'required|numeric|min:0',
            'term' => 'required|numeric|min:0',
            'interest_type' => 'required|in:fixed,declining',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->first());
        }

        LoanType::create([
            'name' => $request->name,
            'interest_rate' => $request->interest_rate,
            'max_amount' => $request->max_amount,
            'min_amount' => $request->min_amount,
            'term' => $request->term,
            'interest_type' => $request->interest_type,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Loan Type Created Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanType $loanType)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'interest_rate' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0',
            'min_amount' => 'required|numeric|min:0',
            'term' => 'required|numeric|min:0',
            'interest_type' => 'required|in:fixed,declining',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->first());
        }

        $loanType->update([
            'name' => $request->name,
            'interest_rate' => $request->interest_rate,
            'max_amount' => $request->max_amount,
            'min_amount' => $request->min_amount,
            'term' => $request->term,
            'interest_type' => $request->interest_type,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Loan Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanType $loanType)
    {
        $loanType->delete();
        return redirect()->back()->with('success', 'Loan Type Deleted Successfully');
    }
}
