<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class WelcomeController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('welcome', compact('plans'));
    }
}
