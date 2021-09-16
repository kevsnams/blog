<?php

use App\Contents\Articles;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class TestArticle extends TestCase
{
    public function test_md_file_should_not_return_404()
    {
        $article = $this->createArticleFrom('test-foo-bar.md');

        $this->assertEquals('test-foo-bar', $article->slug);
    }

    public function test_non_md_file_should_fail()
    {
        $this->expectException(FileNotFoundException::class);
        $this->createArticleFrom('not-md-file.txt');
    }

    public function test_articles_finders_should_succeed()
    {
        $articles = Articles::all(base_path('tests/markdown/'), true);

        foreach ($articles as $article) {
            $this->assertEquals(
                pathinfo($article->file, PATHINFO_EXTENSION), 'md'
            );
        }
    }

    // TODO: Write more tests
}
