<?php
declare(strict_types=1);

namespace App\Contents;

use DirectoryIterator;
use Ramsey\Collection\ArrayInterface;
use Ramsey\Collection\Collection;

class Pages extends Collection implements ArrayInterface
{
    public function __construct($markdownRootDirectory)
    {
        parent::__construct('array', $this->definePages($markdownRootDirectory));
    }

    /**
     * Search the markdown root directory for md files
     * 
     * @param mixed $path The path to iterate
     * 
     * @return array
     */
    protected function definePages($path) : array
    {
        $pages          = [];
        $pagesDirectory = new DirectoryIterator($path);

        foreach ($pagesDirectory as $pageInfo) {
            if (!$pageInfo->isDot()) {
                if ($pageInfo->isDir() && !in_array($pageInfo->getFilename(), array_keys($this->data))) {
                    $pages[$pageInfo->getFilename()] = $this->definePages($pageInfo->getRealPath());
                }

                if ($pageInfo->isFile()) {
                    $pageFileInfo = $pageInfo->getFileInfo();

                    if ($pageFileInfo->getExtension() !== 'md') {
                        continue;
                    }

                    $pages[] = new Page($pageFileInfo);
                }
            }
        }

        return $pages;
    }
}