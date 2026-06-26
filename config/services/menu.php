<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BitExpert\SyliusProductDocumentPlugin\Menu\AdminMenuListener;
use BitExpert\SyliusProductDocumentPlugin\Menu\ProductFormMenuListener;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services
        ->set('bitexpert_product_document.menu.admin', AdminMenuListener::class)
        ->tag('kernel.event_listener', ['event' => 'sylius.menu.admin.main', 'method' => 'addAdminMenuItems']);

    $services
        ->set('bitexpert_product_document.menu.product_form', ProductFormMenuListener::class)
        ->tag('kernel.event_listener', ['event' => 'sylius.menu.admin.product.form', 'method' => 'addItems']);
};
