<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261029015825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mode_cotisation ALTER create_at DROP DEFAULT');
        $this->addSql('ALTER TABLE pret ALTER create_at DROP DEFAULT');
        $this->addSql('ALTER TABLE remboursement ALTER create_at DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER create_at DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mode_cotisation ALTER create_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE pret ALTER create_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE remboursement ALTER create_at SET DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE "user" ALTER create_at SET DEFAULT CURRENT_TIMESTAMP');
    }
}
