<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230409102646 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE site ADD category_id INT NOT NULL, ADD status INT NOT NULL, ADD confirmation_code VARCHAR(80) NOT NULL, ADD email VARCHAR(80) NOT NULL, ADD description VARCHAR(80) NOT NULL, ADD ip VARCHAR(80) NOT NULL, ADD created_at VARCHAR(80) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE site DROP category_id, DROP status, DROP confirmation_code, DROP email, DROP description, DROP ip, DROP created_at');
    }
}
