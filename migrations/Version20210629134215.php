<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210629134215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance ADD checked_at DATETIME DEFAULT NULL, ADD status VARCHAR(255) NOT NULL, DROP arrive_at, DROP leave_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attendance ADD arrive_at DATETIME NOT NULL, ADD leave_at DATETIME NOT NULL, DROP checked_at, DROP status');
    }
}
