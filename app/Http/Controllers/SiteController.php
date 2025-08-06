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
        $meta_title = 'M&H Construction and Design | Custom Design, Construction & Renovation';
        $meta_description = 'We design and build elegant, high-quality homes and interiors across South Carolina, Florida . From concept to completion — we bring your vision to life.';
        $og_title = 'M&H Construction and Design | Custom Design, Construction & Renovation';
        $og_description = 'We design and build elegant, high-quality homes and interiors across South Carolina, Florida . From concept to completion — we bring your vision to life.';

        return view('index', compact('projects', 'meta_title', 'meta_description', 'og_title', 'og_description'));
    }
}
