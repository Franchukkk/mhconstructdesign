<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class SiteController extends Controller
{
    function index()
    {
        // Fetch the latest 3 projects for the homepage
        $projects = Project::latest()->take(5)->get()->toArray();
        return view('index', compact('projects'));
    }
}
