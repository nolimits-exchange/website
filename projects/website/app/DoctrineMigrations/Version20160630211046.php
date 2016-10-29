<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160630211046 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sql = <<<SQL
CREATE VIEW search AS SELECT
 f.id, 
 f.status,
 f.name,
 f.screenshot_ext,
 f.coaster_ext,
 u.id AS user_id,
 u.username AS user_username,
 s.id AS style_id,
 s.name AS style_name,
 s.short AS style_short,
 COALESCE(f.downloads, 0) as downloads,
 COALESCE(f.rating, 0.00) as rating
FROM files AS f
JOIN users u ON f.author_id = u.id
JOIN nolimits_coaster_styles s ON f.style_id = s.id
SQL;
        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP VIEW IF EXISTS search;');
    }
}
