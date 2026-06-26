<?php

/*
 * This file is part of the Sylius Product Document package.
 *
 * (c) bitExpert AG
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace BitExpert\SyliusProductDocumentPlugin\Uploader;

use BitExpert\SyliusProductDocumentPlugin\Model\DocumentInterface;
use League\Flysystem\FilesystemOperator;

final class Uploader implements UploaderInterface
{
    public function __construct(private readonly FilesystemOperator $filesystem)
    {
    }

    public function upload(DocumentInterface $document): void
    {
        if (!$document->hasFile()) {
            return;
        }

        if ($document->getPath() !== null && $this->filesystem->fileExists($document->getPath())) {
            $this->filesystem->delete($document->getPath());
        }

        do {
            $hash = md5(uniqid((string) mt_rand(), true));
            $path = $this->buildPath($hash . '.' . $document->getFile()->guessExtension());
        } while ($this->filesystem->fileExists($path));

        $document->setPath($path);

        $this->filesystem->write(
            $path,
            file_get_contents($document->getFile()->getPathname()),
        );
    }

    public function remove(string $path): bool
    {
        if (!$this->filesystem->fileExists($path)) {
            return false;
        }

        $this->filesystem->delete($path);

        return true;
    }

    public function getContent(DocumentInterface $document): string
    {
        return $this->filesystem->read($document->getPath());
    }

    private function buildPath(string $filename): string
    {
        return sprintf('%s/%s/%s', substr($filename, 0, 2), substr($filename, 2, 2), substr($filename, 4));
    }
}
