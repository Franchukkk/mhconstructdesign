<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\BlogPost;
use App\Models\Project;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Генерує sitemap.xml для сайту';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/blog'));

        BlogPost::whereNotNull('published_at')->get()->each(function ($post) use ($sitemap) {
            $sitemap->add(Url::create("/blog/{$post->slug}"));
        });

        Project::all()->each(function ($project) use ($sitemap) {
            $sitemap->add(Url::create("/portfolio/{$project->slug}"));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap успішно створено!');
    }
}
