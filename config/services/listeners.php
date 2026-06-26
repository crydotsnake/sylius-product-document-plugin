<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BitExpert\SyliusProductDocumentPlugin\EventListener\ProductDocumentsUploadListener;
use BitExpert\SyliusProductDocumentPlugin\EventListener\RemoveProductDocumentListener;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services
        ->set('bitexpert_product_document.listener.upload', ProductDocumentsUploadListener::class)
        ->args([service('bitexpert_product_document.uploader')])
        ->tag('kernel.event_listener', ['event' => 'sylius.product.pre_create', 'method' => 'uploadDocuments'])
        ->tag('kernel.event_listener', ['event' => 'sylius.product.pre_update', 'method' => 'uploadDocuments']);

    $services
        ->set('bitexpert_product_document.listener.remove', RemoveProductDocumentListener::class)
        ->args([service('bitexpert_product_document.uploader')])
        ->tag('doctrine.event_listener', ['event' => 'postRemove']);
};
