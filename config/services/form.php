<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use BitExpert\SyliusProductDocumentPlugin\Entity\DocumentType;
use BitExpert\SyliusProductDocumentPlugin\Entity\DocumentTypeTranslation;
use BitExpert\SyliusProductDocumentPlugin\Entity\ProductDocument;
use BitExpert\SyliusProductDocumentPlugin\Form\Extension\ProductTypeExtension;
use BitExpert\SyliusProductDocumentPlugin\Form\Type\DocumentTypeTranslationType;
use BitExpert\SyliusProductDocumentPlugin\Form\Type\DocumentTypeType;
use BitExpert\SyliusProductDocumentPlugin\Form\Type\ProductDocumentType;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services
        ->set(DocumentTypeType::class)
        ->args([DocumentType::class, []])
        ->tag('form.type');

    $services
        ->set(DocumentTypeTranslationType::class)
        ->args([DocumentTypeTranslation::class, []])
        ->tag('form.type');

    $services
        ->set(ProductDocumentType::class)
        ->args([ProductDocument::class, []])
        ->tag('form.type');

    $services
        ->set(ProductTypeExtension::class)
        ->tag('form.type_extension');
};
