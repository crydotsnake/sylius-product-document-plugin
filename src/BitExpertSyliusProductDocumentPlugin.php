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

namespace BitExpert\SyliusProductDocumentPlugin;

use BitExpert\SyliusProductDocumentPlugin\DependencyInjection\BitExpertSyliusProductDocumentPluginExtension;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class BitExpertSyliusProductDocumentPlugin extends Bundle
{
    use SyliusPluginTrait;

    public function getContainerExtension(): ExtensionInterface
    {
        return new BitExpertSyliusProductDocumentPluginExtension();
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
