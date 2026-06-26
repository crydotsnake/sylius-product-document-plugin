<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BitExpert\SyliusProductDocumentPlugin\Grid\DocumentTypeGrid;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services
        ->set(DocumentTypeGrid::class)
        ->autoconfigure();
};
