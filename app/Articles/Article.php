<?php
namespace App\Articles;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Article implements Arrayable
{
    protected Document $document;

    public string|null $slug;
    public string|null $title;
    public Body $body;
    public string|null $status;
    public string|null $category;

    /**
     * I didn't know I can do something like this in php
     */
    public string|null|int $foo;

    public Carbon $published_at;

    public function __construct(
        public string|null $file,
        bool $isFullPath = false
    ) {

        if ($isFullPath && pathinfo($file, PATHINFO_EXTENSION) !== 'md') {
            throw new FileNotFoundException();
        }
        
        $this->document = YamlFrontMatter::parse(
            File::get($isFullPath ? $file : base_path("app/Articles/Pages/{$file}.md"))
        );

        /**
         * BEWARE!
         * This won't work with filenames with ñ
         * Worry about this later
         */
        $this->slug = basename($file, '.md');

        $this->body         = new Body($this->document->body());
        $this->title        = $this->document->matter('title');
        $this->status       = $this->document->matter('status');
        $this->category     = $this->document->matter('category');
        $this->published_at = Carbon::parse($this->document->matter('published_at'));
    }

    public function getHumanReadableDate() : string
    {
        return $this->published_at->format('F j, Y');
    }

    public function getAgoDate() : string
    {
        return $this->published_at->diffForHumans();
    }

    public function toArray() : array
    {
        return [
            'title'        => $this->title,
            'body'         => $this->body,
            'status'       => $this->status,
            'category'     => $this->category,
            'published_at' => $this->published_at
        ];
    }
}
