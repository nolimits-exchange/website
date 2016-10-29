<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160611160841 extends AbstractMigration
{
    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE `files` DROP FOREIGN KEY `fk_style1`;');
        $this->addSql('ALTER TABLE `files` CHANGE `style_id` `style_id` MEDIUMINT(8)  UNSIGNED  NULL;');
        $this->addSql('ALTER TABLE `files` ADD CONSTRAINT `fk_style1` FOREIGN KEY (`style_id`) REFERENCES `nolimits_coaster_styles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;');
    }

    /**
     * @param Schema $schema
     *
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE `files` DROP FOREIGN KEY `fk_style1`;');
        $this->addSql('ALTER TABLE `files` CHANGE `style_id` `style_id` MEDIUMINT(8)  UNSIGNED  NOT NULL;');
        $this->addSql('ALTER TABLE `files` ADD CONSTRAINT `fk_style1` FOREIGN KEY (`style_id`) REFERENCES `nolimits_coaster_styles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;');
    }
}
