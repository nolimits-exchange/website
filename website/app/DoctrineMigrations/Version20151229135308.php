<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151229135308 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $table = $schema->getTable('users');

        $this->connection->executeUpdate('UPDATE users SET last_login = NULL');

        $table->dropIndex('uniq_username');
        $table->dropIndex('uniq_email');
        $table->dropIndex('ip_address');
        $table->dropIndex('score');
        $table->dropIndex('registration_ip_address');
        $table->dropIndex('registration_date');

        $table->dropColumn('logins');
        $table->dropColumn('ip_address');
        $table->dropColumn('score');
        $table->dropColumn('registration_ip_address');
        $table->dropColumn('registration_date');
        $table->dropColumn('last_login');

        $table->addColumn('username_canonical', 'string', ['length' => 255, 'notnull' => true]);
        $table->addColumn('email_canonical', 'string', ['length' => 255, 'notnull' => true]);
        $table->addColumn('enabled', 'boolean', ['notnull' => true]);
        $table->addColumn('salt', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('expires_at', 'datetime', ['notnull' => false]);
        $table->addColumn('confirmation_token', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('password_requested_at', 'datetime', ['notnull' => false]);
        $table->addColumn('roles', 'array', ['notnull' => true]);
        $table->addColumn('credentials_expire_at', 'datetime', ['notnull' => false]);
        $table->addColumn('last_login', 'datetime', ['notnull' => false]);

        $table->changeColumn('email', ['length' => 255, 'notnull' => true]);
        $table->changeColumn('username', ['length' => 255, 'notnull' => true]);
        $table->changeColumn('password', ['length' => 255, 'notnull' => true]);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {

    }
}
