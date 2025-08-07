<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SeoCheckCommand extends Command
{
    protected $signature = 'seo:check';
    protected $description = 'Перевірка canonical, 301-редіректів і дублікатів title';

    protected $urls = [
        'https://mhconstructdesign.com',
        'https://mhconstructdesign.com/',
        'https://mhconstructdesign.com/blog',
        'https://mhconstructdesign.com/portfolio',
        'https://mhconstructdesign.com/portfolio/good-hope-rd-coastal-craft',
        'https://mhconstructdesign.com/portfolio/hanover-shadow-light',
        'https://mhconstructdesign.com/contact-request',
    ];

    protected $titles = [];

    public function handle()
    {
        foreach ($this->urls as $url) {
            $this->info("🔍 Перевірка: $url");

            try {
                $response = Http::withHeaders([
                    'User-Agent' => 'LaravelSEOChecker/1.0'
                ])->get($url);

                $status = $response->status();
                $finalUrl = $response->effectiveUri() ?? $url;

                if ($url !== (string)$finalUrl) {
                    $this->warn("↪️ Редірект: $url → $finalUrl");
                } else {
                    $this->line("✅ Без редіректу");
                }

                if ($status !== 200) {
                    $this->error("❌ Статус: $status");
                    continue;
                }

                $html = $response->body();

                // Перевірка title
                if (preg_match('/<title>(.*?)<\/title>/si', $html, $matches)) {
                    $title = trim($matches[1]);
                    $this->line("📄 Title: $title");
                    if (in_array($title, $this->titles)) {
                        $this->warn("⚠️ Дублікат title!");
                    } else {
                        $this->titles[] = $title;
                    }
                } else {
                    $this->error("❌ Title відсутній!");
                }

                // Перевірка canonical
                if (preg_match('/<link[^>]+rel=["\']canonical["\'][^>]+href=["\']([^"\']+)["\']/i', $html, $matches)) {
                    $canonical = $matches[1];
                    $this->line("🔗 Canonical: $canonical");
                } else {
                    $this->warn("❌ Canonical відсутній!");
                }

            } catch (\Exception $e) {
                $this->error("Помилка: {$e->getMessage()}");
            }

            $this->line(str_repeat('-', 60));
        }

        $this->info("✅ Перевірка завершена!");
    }
}
