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
        else 
        {
            try {
                Excel::import(new LeadsImport, request()->file('file'));
                Session::flash('success', 'Leads uploaded successfully.');
                return redirect(route('admin.feeds.index'));
            } catch (\Exception $e) {
                Session::flash('danger', $e->getMessage());
                return redirect(route('admin.feeds.index'));
            }
        } 
    } 
}
