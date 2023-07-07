<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504145605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        //$this->addSql('DROP TABLE sites777');
        $this->addSql('ALTER TABLE site CHANGE name name VARCHAR(128) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        //$this->addSql('CREATE TABLE sites777 (id INT DEFAULT NULL, cat1 INT DEFAULT NULL, cat2 INT DEFAULT NULL, region_id INT DEFAULT NULL, url TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, domain TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, name TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, `desc` TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, desc_full TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, email TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, added_at TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, ip TEXT CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE site CHANGE name name VARCHAR(80) NOT NULL');
    }
}
