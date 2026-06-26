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

interface UploaderInterface
{
    public function upload(DocumentInterface $document): void;

    public function remove(string $path): bool;

    public function getContent(DocumentInterface $document): string;
}
