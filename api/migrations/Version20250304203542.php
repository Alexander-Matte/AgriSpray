<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250304203542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aircrafts (id UUID NOT NULL, make VARCHAR(50) NOT NULL, model VARCHAR(100) NOT NULL, callsign VARCHAR(10) NOT NULL, max_capacity_liters INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE chemicals (id UUID NOT NULL, name VARCHAR(255) NOT NULL, manufacturer VARCHAR(255) NOT NULL, application_rate_lph DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE customers (id UUID NOT NULL, company_name VARCHAR(255) DEFAULT NULL, first_name VARCHAR(100) DEFAULT NULL, last_name VARCHAR(100) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE fields (id UUID NOT NULL, customer_id UUID NOT NULL, total_ha INT NOT NULL, crop_type VARCHAR(30) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7EE5E3889395C3F3 ON fields (customer_id)');
        $this->addSql('CREATE TABLE job_profiles (id UUID NOT NULL, aircraft_id UUID NOT NULL, customer_id UUID NOT NULL, field_id UUID NOT NULL, chemical_id UUID NOT NULL, loader_id UUID NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EC77204B846E2F5C ON job_profiles (aircraft_id)');
        $this->addSql('CREATE INDEX IDX_EC77204B9395C3F3 ON job_profiles (customer_id)');
        $this->addSql('CREATE INDEX IDX_EC77204B443707B0 ON job_profiles (field_id)');
        $this->addSql('CREATE INDEX IDX_EC77204BE1770A76 ON job_profiles (chemical_id)');
        $this->addSql('CREATE INDEX IDX_EC77204BE2D5521C ON job_profiles (loader_id)');
        $this->addSql('CREATE TABLE load_details (id UUID NOT NULL, load_plan_id UUID NOT NULL, load_number INT NOT NULL, chemical_liters DOUBLE PRECISION NOT NULL, water_liters DOUBLE PRECISION NOT NULL, total_liters DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C9470F6053F80671 ON load_details (load_plan_id)');
        $this->addSql('CREATE TABLE load_plans (id UUID NOT NULL, job_id UUID NOT NULL, strategy VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6AEDFC0BE04EA9 ON load_plans (job_id)');
        $this->addSql('CREATE TABLE loaders (id UUID NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pilots (id UUID NOT NULL, aircraft_id UUID DEFAULT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9EE6E18C846E2F5C ON pilots (aircraft_id)');
        $this->addSql('ALTER TABLE fields ADD CONSTRAINT FK_7EE5E3889395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_profiles ADD CONSTRAINT FK_EC77204B846E2F5C FOREIGN KEY (aircraft_id) REFERENCES aircrafts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_profiles ADD CONSTRAINT FK_EC77204B9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_profiles ADD CONSTRAINT FK_EC77204B443707B0 FOREIGN KEY (field_id) REFERENCES fields (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_profiles ADD CONSTRAINT FK_EC77204BE1770A76 FOREIGN KEY (chemical_id) REFERENCES chemicals (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_profiles ADD CONSTRAINT FK_EC77204BE2D5521C FOREIGN KEY (loader_id) REFERENCES loaders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE load_details ADD CONSTRAINT FK_C9470F6053F80671 FOREIGN KEY (load_plan_id) REFERENCES load_plans (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE load_plans ADD CONSTRAINT FK_C6AEDFC0BE04EA9 FOREIGN KEY (job_id) REFERENCES job_profiles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pilots ADD CONSTRAINT FK_9EE6E18C846E2F5C FOREIGN KEY (aircraft_id) REFERENCES aircrafts (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE fields DROP CONSTRAINT FK_7EE5E3889395C3F3');
        $this->addSql('ALTER TABLE job_profiles DROP CONSTRAINT FK_EC77204B846E2F5C');
        $this->addSql('ALTER TABLE job_profiles DROP CONSTRAINT FK_EC77204B9395C3F3');
        $this->addSql('ALTER TABLE job_profiles DROP CONSTRAINT FK_EC77204B443707B0');
        $this->addSql('ALTER TABLE job_profiles DROP CONSTRAINT FK_EC77204BE1770A76');
        $this->addSql('ALTER TABLE job_profiles DROP CONSTRAINT FK_EC77204BE2D5521C');
        $this->addSql('ALTER TABLE load_details DROP CONSTRAINT FK_C9470F6053F80671');
        $this->addSql('ALTER TABLE load_plans DROP CONSTRAINT FK_C6AEDFC0BE04EA9');
        $this->addSql('ALTER TABLE pilots DROP CONSTRAINT FK_9EE6E18C846E2F5C');
        $this->addSql('DROP TABLE aircrafts');
        $this->addSql('DROP TABLE chemicals');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE fields');
        $this->addSql('DROP TABLE job_profiles');
        $this->addSql('DROP TABLE load_details');
        $this->addSql('DROP TABLE load_plans');
        $this->addSql('DROP TABLE loaders');
        $this->addSql('DROP TABLE pilots');
    }
}
