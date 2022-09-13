<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620131947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE color_id_seq CASCADE');
        $this->addSql('CREATE TABLE product_color (id_product INT NOT NULL, id_color INT NOT NULL, PRIMARY KEY(id_product, id_color))');
        $this->addSql('CREATE INDEX IDX_C70A33B5DD7ADDD ON product_color (id_product)');
        $this->addSql('CREATE INDEX IDX_C70A33B588D309D9 ON product_color (id_color)');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B5DD7ADDD FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B588D309D9 FOREIGN KEY (id_color) REFERENCES color (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product DROP color');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE color_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP TABLE product_color');
        $this->addSql('ALTER TABLE product ADD color VARCHAR(50) DEFAULT NULL');
    }
}
