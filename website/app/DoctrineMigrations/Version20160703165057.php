<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160703165057 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sql = <<<SQL
CREATE TABLE queue_message (id INT AUTO_INCREMENT NOT NULL, queue_id INT DEFAULT NULL, handle VARCHAR(32) DEFAULT NULL, body LONGTEXT NOT NULL, md5 VARCHAR(32) NOT NULL, timeout NUMERIC(10, 0) DEFAULT NULL, created INT NOT NULL, priority SMALLINT NOT NULL, failed TINYINT(1) NOT NULL, num_retries INT NOT NULL, ended TINYINT(1) NOT NULL, INDEX IDX_543FAB41477B5BAE (queue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE queue_log (id INT AUTO_INCREMENT NOT NULL, message_id INT DEFAULT NULL, date_log DATETIME NOT NULL, log LONGTEXT NOT NULL, INDEX IDX_D5C2F5E2537A1329 (message_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE queue (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, timeout SMALLINT NOT NULL, max_retries INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE search (id INT NOT NULL, status INT NOT NULL, name VARCHAR(245) NOT NULL, rating DOUBLE PRECISION NOT NULL, downloads INT NOT NULL, user_id INT NOT NULL, user_username VARCHAR(255) NOT NULL, style_id INT NOT NULL, style_name VARCHAR(255) NOT NULL, style_short VARCHAR(50) NOT NULL, screenshot_ext VARCHAR(4) NOT NULL, coaster_ext VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE search_types (id INT NOT NULL, name VARCHAR(255) NOT NULL, version INT NOT NULL, count INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE queue_message ADD CONSTRAINT FK_543FAB41477B5BAE FOREIGN KEY (queue_id) REFERENCES queue (id);
ALTER TABLE queue_log ADD CONSTRAINT FK_D5C2F5E2537A1329 FOREIGN KEY (message_id) REFERENCES queue_message (id);
SQL;

        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $sql = <<<SQL
DROP IF EXISTS TABLE queue_message; 
DROP IF EXISTS TABLE queue_log; 
DROP IF EXISTS TABLE queue; 
DROP IF EXISTS TABLE search; 
DROP IF EXISTS TABLE search_types; 
SQL;

        $this->addSql($sql);
    }
}
