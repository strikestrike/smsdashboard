<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Validator;

class ImportController extends Controller
{

    public function index()
    {
        return view('admin.feeds.index');
    }

    public function postUploadExcel(Request $request)
    {
        $rules = array(
            'file' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails())
        {
            return redirect(route('admin.feeds.index'))->withErrors($validator);
        }

        $import = new LeadsImport;

        try {
            Excel::import($import, request()->file('file'));

            $successCount = $import->getSuccessCount();
            $errorCount = $import->getErrorCount();

            if ($request->ajax()) {
                return response()->json(['success' => TRUE, 'message' => "$successCount leads uploaded successfully. $errorCount leads returned errors."]);
            } else {
                Session::flash('success', "$successCount leads uploaded successfully. $errorCount leads returned errors.");
                return redirect(route('admin.feeds.index'));
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => FALSE, 'message' => $e->getMessage()]);
            } else {
                Session::flash('danger', $e->getMessage());
                return redirect(route('admin.feeds.index'));
            }
        }
    }
}
