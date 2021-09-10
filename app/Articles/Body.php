<?php
namespace App\Articles;

use Illuminate\Contracts\Support\Arrayable;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;

class Body implements Arrayable
{
    protected string $parsed;

    public function __construct(
        protected string $raw
    ) {
        $environment = new Environment([
            'html_input'         => 'strip',
            'allow_unsafe_links' => false
        ]);
        
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new AttributesExtension());
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        $converter = new MarkdownConverter($environment);

        $this->parsed = $converter->convertToHtml($this->raw);
    }

    public function getMarkdown() : string
    {
        return $this->raw;
    }

    public function getHtml() : string
    {
        return $this->parsed;
    }

    public function toArray() : array
    {
        return [
            'html'     => $this->getHtml(),
            'markdown' => $this->getMarkdown()
        ];
    }
}