<?php
declare(strict_types=1);

namespace App\Contents;

use Laravel\Lumen\Routing\Router;

/**
 * Markdown CMS
 */
abstract class MDCMS
{
    public static Pages $pages;

    public static function initialize(Router $router)
    {
        self::$pages = new Pages(Config::rootDirectory());

        self::defineRoutes($router);
    }

    private static function defineRoutes(Router $router)
    {
        self::iterateThrough(self::$pages->toArray(), $router);
    }

    private static function iterateThrough(array $pages, Router $router)
    {
        foreach ($pages as $page) {
            if (is_array($page)) {
                self::iterateThrough($page, $router);
            }

            if ($page instanceof Page) {
                $router->get($page->routePath . $page->slug, function () use ($page) {
                    return view('page', [ 'page' => $page ]);
                });
            }
        }
    }
}