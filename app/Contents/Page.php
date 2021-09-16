<?php
declare(strict_types=1);

namespace App\Contents;

use App\Contents\Exceptions\NotMdFileException;
use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use SplFileInfo;

class Page
{
    public string $slug;
    public string $routePath;
    public Body $body;
    
    protected Document $document;
    protected SplFileInfo $file;

    public function __construct($file)
    {
        $this->file = $file;

        if ($this->file->getExtension() !== 'md') {
            throw new NotMdFileException();
        }

        $this->slug = pathinfo($this->file->getPathname(), PATHINFO_FILENAME);

        $this->routePath = sprintf(
            "/%s/",
                preg_replace(
                    "/(.*)". str_replace('/', '\/', Config::rootDirectory()) ."/",
                    '',
                    $this->file->getPath()
                )
        );

        $this->document = YamlFrontMatter::parse(
            file_get_contents($this->file->getRealPath())
        );

        $this->body = new Body($this->document->body());
    }
}