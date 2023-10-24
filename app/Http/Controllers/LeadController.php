<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    
    public function index()
    {
        $data = Lead::orderBy('id','DESC')->get();
        return view('admin.lead.index', compact('data'));
    }
}
