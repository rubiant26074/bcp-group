<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::where('status', 'active')->latest()->get();
        return view('pages.careers', compact('careers'));
    }
}
