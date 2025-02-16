<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDocuments;
use App\Traits\DocumentUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeDocumentsController extends Controller
{
    use DocumentUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employeeId = request()->get('employee_id');
        session(['employee_id' => $employeeId]);
        $title = 'Employee Documents';
        $subTitle = 'List of Employee Documents';
        $employeeDocuments = EmployeeDocuments::where('employee_id', $employeeId)->get();
        return view('pages.documents.index', compact('employeeDocuments', 'title', 'employeeId', 'subTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employeeId = session('employee_id');
        if(!$employeeId){
            return redirect()->back()->with('error', 'Employee not found');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $document = $this->documentUploadTrait($request->file('file'), null, 'employee', 5120);

        EmployeeDocuments::create([
            'employee_id' => $employeeId,
            'name' => $request->name,
            'file' => $document,
        ]);


        return redirect()->back()->with('success', 'Document uploaded successfully');        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employeeDocuments = EmployeeDocuments::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $document = $employeeDocuments->file;
        if($request->hasFile('file')){
            $document = $this->documentUploadTrait($request->file('file'), $employeeDocuments->file, 'employee', 5120);
        }

        $employeeDocuments->update([
            'name' => $request->name,
            'file' => $document,
        ]);

        return redirect()->back()->with('success', 'Document updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employeeDocuments = EmployeeDocuments::find($id);
        $employeeDocuments->delete();
        @unlink('assets/documents/employee/'.$employeeDocuments->file);
        return redirect()->back()->with('success', 'Document deleted successfully');
    }
}
