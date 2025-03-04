<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304204628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pilots DROP CONSTRAINT fk_9ee6e18c846e2f5c');
        $this->addSql('DROP INDEX idx_9ee6e18c846e2f5c');
        $this->addSql('ALTER TABLE pilots RENAME COLUMN aircraft_id TO aircrafts_id');
        $this->addSql('ALTER TABLE pilots ADD CONSTRAINT FK_9EE6E18C8528CED5 FOREIGN KEY (aircrafts_id) REFERENCES aircrafts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9EE6E18C8528CED5 ON pilots (aircrafts_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pilots DROP CONSTRAINT FK_9EE6E18C8528CED5');
        $this->addSql('DROP INDEX IDX_9EE6E18C8528CED5');
        $this->addSql('ALTER TABLE pilots RENAME COLUMN aircrafts_id TO aircraft_id');
        $this->addSql('ALTER TABLE pilots ADD CONSTRAINT fk_9ee6e18c846e2f5c FOREIGN KEY (aircraft_id) REFERENCES aircrafts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9ee6e18c846e2f5c ON pilots (aircraft_id)');
    }
}
