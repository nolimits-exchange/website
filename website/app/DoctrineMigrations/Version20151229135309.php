<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151229135309 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('UPDATE users SET username_canonical = LOWER(username)');
        $this->addSql('UPDATE users SET email_canonical = LOWER(email)');
        $this->addSql('UPDATE users SET enabled = 1');
        $this->addSql('UPDATE users SET roles = "a:0:{}"');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {

    }
}
