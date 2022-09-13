<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609195100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP CONSTRAINT fk_d4e6f81cbf180eb');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT fk_d34a04adcbf180eb');
        $this->addSql('DROP SEQUENCE supplier_id_supplier_seq CASCADE');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP INDEX idx_d4e6f81cbf180eb');
        $this->addSql('ALTER TABLE address DROP id_supplier');
        $this->addSql('DROP INDEX idx_d34a04adcbf180eb');
        $this->addSql('ALTER TABLE product DROP id_supplier');
        $this->addSql('ALTER TABLE product ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE product ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE product ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE "user" ALTER telephone TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER telephone DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER telephone SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE supplier_id_supplier_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE supplier (id_supplier INT NOT NULL, contact_name VARCHAR(50) DEFAULT NULL, address VARCHAR(50) DEFAULT NULL, supplier_country_code VARCHAR(50) DEFAULT NULL, telephone INT DEFAULT NULL, PRIMARY KEY(id_supplier))');
        $this->addSql('ALTER TABLE address ADD id_supplier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT fk_d4e6f81cbf180eb FOREIGN KEY (id_supplier) REFERENCES supplier (id_supplier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d4e6f81cbf180eb ON address (id_supplier)');
        $this->addSql('ALTER TABLE "user" ALTER telephone TYPE INT');
        $this->addSql('ALTER TABLE "user" ALTER telephone DROP DEFAULT');
        $this->addSql('ALTER TABLE "user" ALTER telephone DROP NOT NULL');
        $this->addSql('ALTER TABLE product ADD id_supplier INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ALTER description TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE product ALTER description DROP DEFAULT');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT fk_d34a04adcbf180eb FOREIGN KEY (id_supplier) REFERENCES supplier (id_supplier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d34a04adcbf180eb ON product (id_supplier)');
    }
}
