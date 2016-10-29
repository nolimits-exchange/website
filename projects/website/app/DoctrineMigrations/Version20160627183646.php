<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160627183646 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sql = <<<SQL
CREATE VIEW search_types AS SELECT 
	nolimits_coaster_styles.id,
	nolimits_coaster_styles.name,
	nolimits_coaster_styles.version,
	COUNT(nolimits_coaster_styles.id) as count
FROM 
	nolimits_coaster_styles
JOIN files ON nolimits_coaster_styles.id = files.style_id
GROUP BY nolimits_coaster_styles.id
SQL;

        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP VIEW IF EXISTS search_types;');
    }
}
