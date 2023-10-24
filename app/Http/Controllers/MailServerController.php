<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class MailServerController extends Controller
{
    
    public function index()
    {
        $data = Lead::orderBy('id','DESC')->get();
        return view('admin.mailserver.index', compact('data'));
    }
}
