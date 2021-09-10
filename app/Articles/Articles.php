<?php
namespace App\Articles;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

abstract class Articles
{
    /**
     * TODO create APP_ARTICLE_PAGE_DIR (also update Article class)
     */
    public static function all(string $basepath = 'app/Articles/Pages', $isFullPath = false) : Collection
    {
        if (!$isFullPath) {
            $basepath = base_path($basepath);
        }

        return collect(File::allFiles($basepath))
            ->sortByDesc(
                fn ($file) => $file->getBaseName()
            )
            ->filter(
                fn ($file) => str_ends_with($file->getBaseName(), '.md')
            )
            ->map(
                fn ($file) => new Article($file->getRealPath(), $isFullPath)
            );
    }

    public static function find(string $slug) : Article
    {
        return new Article($slug);
    }
}