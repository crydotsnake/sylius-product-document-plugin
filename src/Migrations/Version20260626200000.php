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

namespace BitExpertSyliusProductDocumentPlugin;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260626200000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add missing locale and translatable_id columns to document type translation table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE bitexpert_sylius_document_type_translation ADD translatable_id INT NOT NULL, ADD locale VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE bitexpert_sylius_document_type_translation ADD CONSTRAINT FK_DOCTYPE_TRANS FOREIGN KEY (translatable_id) REFERENCES bitexpert_sylius_document_type (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_DOCTYPE_TRANS_ID ON bitexpert_sylius_document_type_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX bitexpert_sylius_document_type_translation_uniq_trans ON bitexpert_sylius_document_type_translation (translatable_id, locale)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE bitexpert_sylius_document_type_translation DROP FOREIGN KEY FK_DOCTYPE_TRANS');
        $this->addSql('DROP INDEX IDX_DOCTYPE_TRANS_ID ON bitexpert_sylius_document_type_translation');
        $this->addSql('DROP INDEX bitexpert_sylius_document_type_translation_uniq_trans ON bitexpert_sylius_document_type_translation');
        $this->addSql('ALTER TABLE bitexpert_sylius_document_type_translation DROP translatable_id, DROP locale, CHANGE name name VARCHAR(255) NOT NULL');
    }
}
