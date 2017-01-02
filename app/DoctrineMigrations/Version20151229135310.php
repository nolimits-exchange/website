<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151229135310 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $table = $schema->getTable('users');

        $table->addUniqueIndex(['username_canonical'], 'uniq_username_canonical');
        $table->addUniqueIndex(['email_canonical'], 'uniq_email_canonical');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $table = $schema->getTable('users');

        $table->dropIndex('uniq_username_canonical');
        $table->dropIndex('uniq_email_canonical');
    }
}
