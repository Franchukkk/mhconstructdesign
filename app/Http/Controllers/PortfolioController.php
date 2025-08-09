<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(9);

        $meta_title = 'Interior Design Portfolio | M&H Construction';
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

        $design_images_raw = $project->galleryItems->pluck('design_image')->filter()->values();
        $real_images_raw = $project->galleryItems->pluck('real_image')->filter()->values();

        // Функція для отримання масиву з 'path' і 'ratio'
        $prepareImagesWithRatio = function ($images) {
            $result = [];
            foreach ($images as $image) {
                $path = storage_path('app/public/' . $image);
                if (file_exists($path)) {
                    [$width, $height] = getimagesize($path);
                    $ratio = $height != 0 ? $width / $height : 1; // уникнути ділення на 0
                    $result[] = [
                        'path' => $image,
                        'ratio' => $ratio,
                    ];
                }
            }
            return $result;
        };

        $design_images = $prepareImagesWithRatio($design_images_raw);
        $real_images = $prepareImagesWithRatio($real_images_raw);

        // Сортуємо за ratio
        usort($design_images, fn($a, $b) => $a['ratio'] <=> $b['ratio']);
        usort($real_images, fn($a, $b) => $a['ratio'] <=> $b['ratio']);

        $meta_title = $project->meta_title ?? $project->title;
        $meta_description = $project->meta_description ?? Str::limit(strip_tags($project->description), 160);
        $og_title = $project->title;
        $og_description = $meta_description;
        $og_image = $project->portfolio_cover
            ? asset('storage/' . $project->portfolio_cover)
            : asset('default-og-image.jpg');

        $designDescriptions = json_decode($project->design_description ?? '[]', true);
        $realDescriptions = json_decode($project->realization_description ?? '[]', true);

        return view('portfolio.show', compact(
            'project',
            'design_images',
            'real_images',
            'designDescriptions',
            'realDescriptions',
            'meta_title',
            'meta_description',
            'og_title',
            'og_description',
            'og_image'
        ));
    }


}
