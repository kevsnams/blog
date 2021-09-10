<?php

use App\Articles\Article;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function createArticleFrom(string $filename) : Article
    {
        return new Article(
            base_path("tests/markdown/{$filename}"), true
        );
    }
}
