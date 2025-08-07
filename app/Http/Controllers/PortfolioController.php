<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(9);

        $meta_title = 'Our Work | Interior Design & Renovation Portfolio – M&H Construction and Design';
        $meta_description = 'Explore our portfolio of custom design, construction, and renovation projects across South Carolina and Florida. From elegant homes to stunning interiors, we bring your vision to life.';

        return view('portfolio.index', compact('projects', 'meta_title', 'meta_description'));
    }

    // public function show($slug)
    // {
    //     $project = Project::with('galleryItems')->where('slug', $slug)->firstOrFail();

    //     $meta_title = $project->meta_title ?? $project->title;
    //     $meta_description = $project->meta_description ?? Str::limit(strip_tags($project->description), 160);
    //     $og_title = $project->title;
    //     $og_description = $meta_description;
    //     $og_image = $project->main_image
    //         ? asset('storage/' . $project->main_image)
    //         : asset('default-og-image.jpg');

    //     return view('portfolio.show', compact(
    //         'project',
    //         'meta_title',
    //         'meta_description',
    //         'og_title',
    //         'og_description',
    //         'og_image'
    //     ));
    // }

    public function show($slug)
    {
        $project = Project::with('galleryItems')->where('slug', $slug)->firstOrFail();
        $design_images = $project->galleryItems->pluck('design_image')->filter();
        $real_images = $project->galleryItems->pluck('real_image')->filter();

        $meta_title = $project->meta_title ?? $project->title;
        $meta_description = $project->meta_description ?? Str::limit(strip_tags($project->description), 160);
        $og_title = $project->title;
        $og_description = $meta_description;
        $og_image = $project->portfolio_cover
            ? asset('storage/' . $project->portfolio_cover)
            : asset('default-og-image.jpg');

        return view('portfolio.show', compact(
            'project',
            'design_images',
            'real_images',
            'meta_title',
            'meta_description',
            'og_title',
            'og_description',
            'og_image'
        ));
    }

}
