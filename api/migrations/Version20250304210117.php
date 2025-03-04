<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304210117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aircrafts ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN aircrafts.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE chemicals ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN chemicals.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE customers ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN customers.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE fields ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE fields ALTER customer_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN fields.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN fields.customer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE job_profiles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER aircraft_id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER customer_id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER field_id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER chemical_id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER loader_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN job_profiles.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN job_profiles.aircraft_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN job_profiles.customer_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN job_profiles.field_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN job_profiles.chemical_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN job_profiles.loader_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE load_details ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE load_details ALTER load_plan_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN load_details.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN load_details.load_plan_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE load_plans ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE load_plans ALTER job_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN load_plans.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN load_plans.job_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE loaders ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN loaders.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE pilots ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE pilots ADD phone_number VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE pilots ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE pilots ALTER aircrafts_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN pilots.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN pilots.aircrafts_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE load_details ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE load_details ALTER load_plan_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN load_details.id IS NULL');
        $this->addSql('COMMENT ON COLUMN load_details.load_plan_id IS NULL');
        $this->addSql('ALTER TABLE loaders ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN loaders.id IS NULL');
        $this->addSql('ALTER TABLE aircrafts ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN aircrafts.id IS NULL');
        $this->addSql('ALTER TABLE chemicals ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN chemicals.id IS NULL');
        $this->addSql('ALTER TABLE pilots DROP email');
        $this->addSql('ALTER TABLE pilots DROP phone_number');
        $this->addSql('ALTER TABLE pilots ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE pilots ALTER aircrafts_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN pilots.id IS NULL');
        $this->addSql('COMMENT ON COLUMN pilots.aircrafts_id IS NULL');
        $this->addSql('ALTER TABLE customers ALTER id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN customers.id IS NULL');
        $this->addSql('ALTER TABLE fields ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE fields ALTER customer_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN fields.id IS NULL');
        $this->addSql('COMMENT ON COLUMN fields.customer_id IS NULL');
        $this->addSql('ALTER TABLE job_profiles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER aircraft_id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER customer_id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER field_id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER chemical_id TYPE UUID');
        $this->addSql('ALTER TABLE job_profiles ALTER loader_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN job_profiles.id IS NULL');
        $this->addSql('COMMENT ON COLUMN job_profiles.aircraft_id IS NULL');
        $this->addSql('COMMENT ON COLUMN job_profiles.customer_id IS NULL');
        $this->addSql('COMMENT ON COLUMN job_profiles.field_id IS NULL');
        $this->addSql('COMMENT ON COLUMN job_profiles.chemical_id IS NULL');
        $this->addSql('COMMENT ON COLUMN job_profiles.loader_id IS NULL');
        $this->addSql('ALTER TABLE load_plans ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE load_plans ALTER job_id TYPE UUID');
        $this->addSql('COMMENT ON COLUMN load_plans.id IS NULL');
        $this->addSql('COMMENT ON COLUMN load_plans.job_id IS NULL');
    }
}
