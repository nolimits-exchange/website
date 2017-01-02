<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160701202115 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('DELETE FROM nolimits_coaster_styles WHERE version = ?', [0]);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        
    }
}
