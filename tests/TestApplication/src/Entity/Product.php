<?php

declare(strict_types=1);

namespace Tests\BitExpert\SyliusProductDocumentPlugin\Entity;

use BitExpert\SyliusProductDocumentPlugin\Entity\Trait\HasProductDocumentsTrait;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;

#[ORM\Entity]
#[ORM\Table(name: 'sylius_product')]
class Product extends BaseProduct
{
    use HasProductDocumentsTrait;

    public function __construct()
    {
        parent::__construct();
        $this->initializeProductDocumentsCollection();
    }
}
