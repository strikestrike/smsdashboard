<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class CampaignController extends Controller
{
    
    public function index()
    {
        $data = Lead::orderBy('id','DESC')->get();
        return view('admin.campaign.index', compact('data'));
    }
}
