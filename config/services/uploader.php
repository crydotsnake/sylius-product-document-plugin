<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BitExpert\SyliusProductDocumentPlugin\Uploader\Uploader;
use BitExpert\SyliusProductDocumentPlugin\Uploader\UploaderInterface;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services
        ->set('bitexpert_product_document.uploader', Uploader::class)
        ->args([service('bitexpert_product_document.storage')])
        ->public();

    $services->alias(UploaderInterface::class, 'bitexpert_product_document.uploader');
};
