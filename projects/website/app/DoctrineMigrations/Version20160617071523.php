<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160617071523 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $table = $schema->getTable('files');

        $table->changeColumn('screenshot_ext', ['notnull' => false]);
        $table->changeColumn('coaster_ext', ['notnull' => false]);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $table = $schema->getTable('files');

        $table->changeColumn('screenshot_ext', ['notnull' => true]);
        $table->changeColumn('coaster_ext', ['notnull' => true]);
    }
}
