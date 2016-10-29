<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160701201133 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [29, 1]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [30, 2]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [31, 3]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [32, 4]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [33, 5]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [34, 6]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [35, 7]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [36, 8]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [37, 9]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [38, 10]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [39, 11]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [40, 12]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [41, 13]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [42, 14]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [43, 15]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [44, 16]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [45, 17]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [46, 18]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [47, 19]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [48, 20]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [49, 21]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [50, 22]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [51, 23]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [52, 24]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [53, 25]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [54, 26]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [55, 27]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [56, 28]);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [1, 29]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [2, 30]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [3, 31]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [4, 32]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [5, 33]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [6, 34]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [7, 35]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [8, 36]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [9, 37]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [10, 38]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [11, 39]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [12, 40]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [13, 41]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [14, 42]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [15, 43]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [16, 44]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [17, 45]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [18, 46]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [19, 47]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [20, 48]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [21, 49]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [22, 50]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [23, 51]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [24, 52]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [25, 53]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [26, 54]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [27, 55]);
        $this->addSql('UPDATE files SET style_id = ? WHERE style_id = ?', [28, 56]);
    }
}
