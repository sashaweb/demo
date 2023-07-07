<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427123323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_site DROP FOREIGN KEY FK_E2D873A3F6BD1646');
        $this->addSql('ALTER TABLE category_site DROP FOREIGN KEY FK_E2D873A312469DE2');
        $this->addSql('DROP TABLE category_site');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_site (category_id INT NOT NULL, site_id INT NOT NULL, INDEX IDX_E2D873A312469DE2 (category_id), INDEX IDX_E2D873A3F6BD1646 (site_id), PRIMARY KEY(category_id, site_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category_site ADD CONSTRAINT FK_E2D873A3F6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_site ADD CONSTRAINT FK_E2D873A312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }
}
