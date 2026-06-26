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

namespace BitExpert\SyliusProductDocumentPlugin\EventListener;

use BitExpert\SyliusProductDocumentPlugin\Model\ProductDocumentInterface;
use BitExpert\SyliusProductDocumentPlugin\Uploader\UploaderInterface;
use Doctrine\ORM\Event\PostRemoveEventArgs;

final class RemoveProductDocumentListener
{
    public function __construct(private readonly UploaderInterface $uploader)
    {
    }

    public function postRemove(PostRemoveEventArgs $event): void
    {
        $entity = $event->getObject();

        if (!$entity instanceof ProductDocumentInterface) {
            return;
        }

        if ($entity->getPath() !== null) {
            $this->uploader->remove($entity->getPath());
        }
    }
}
