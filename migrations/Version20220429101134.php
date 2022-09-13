<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429101134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE address_id_address_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE category_id_category_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE delivery_id_delivery_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE message_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE orders_id_order_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pay_platform_id_platform_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_product_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE role_id_role_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE size_id_size_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE supplier_id_supplier_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE address (id_address INT NOT NULL, id_supplier INT DEFAULT NULL, country_code VARCHAR(50) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, street VARCHAR(50) DEFAULT NULL, address_aux VARCHAR(50) DEFAULT NULL, postal_code VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id_address))');
        $this->addSql('CREATE INDEX IDX_D4E6F81CBF180EB ON address (id_supplier)');
        $this->addSql('CREATE TABLE category (id_category INT NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id_category))');
        $this->addSql('CREATE TABLE delivery (id_delivery INT NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id_delivery))');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE orders (id_order INT NOT NULL, id_platform INT DEFAULT NULL, id_delivery INT DEFAULT NULL, id INT DEFAULT NULL, statut VARCHAR(50) DEFAULT NULL, invoice_date DATE DEFAULT NULL, total NUMERIC(15, 2) DEFAULT NULL, total_tax NUMERIC(15, 2) DEFAULT NULL, PRIMARY KEY(id_order))');
        $this->addSql('CREATE INDEX IDX_E52FFDEE69893C5E ON orders (id_platform)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE675A0085 ON orders (id_delivery)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE12EB649B ON orders (id)');
        $this->addSql('CREATE TABLE pay_platform (id_platform INT NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id_platform))');
        $this->addSql('CREATE TABLE product (id_product INT NOT NULL, id_supplier INT DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, tag VARCHAR(50) DEFAULT NULL, description VARCHAR(50) DEFAULT NULL, color VARCHAR(50) DEFAULT NULL, weight NUMERIC(15, 2) DEFAULT NULL, material VARCHAR(50) DEFAULT NULL, brand VARCHAR(50) DEFAULT NULL, quantity INT DEFAULT NULL, PRIMARY KEY(id_product))');
        $this->addSql('CREATE INDEX IDX_D34A04ADCBF180EB ON product (id_supplier)');
        $this->addSql('CREATE TABLE associate (id_product INT NOT NULL, id_category INT NOT NULL, PRIMARY KEY(id_product, id_category))');
        $this->addSql('CREATE INDEX IDX_CCE5D25DD7ADDD ON associate (id_product)');
        $this->addSql('CREATE INDEX IDX_CCE5D255697F554 ON associate (id_category)');
        $this->addSql('CREATE TABLE composes (id_product INT NOT NULL, id_order INT NOT NULL, PRIMARY KEY(id_product, id_order))');
        $this->addSql('CREATE INDEX IDX_EF74364EDD7ADDD ON composes (id_product)');
        $this->addSql('CREATE INDEX IDX_EF74364E1BACD2A8 ON composes (id_order)');
        $this->addSql('CREATE TABLE corresponds (id_product INT NOT NULL, id_size VARCHAR(50) NOT NULL, PRIMARY KEY(id_product, id_size))');
        $this->addSql('CREATE INDEX IDX_F606102EDD7ADDD ON corresponds (id_product)');
        $this->addSql('CREATE INDEX IDX_F606102E7CE03868 ON corresponds (id_size)');
        $this->addSql('CREATE TABLE role (id_role INT NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id_role))');
        $this->addSql('CREATE TABLE size (id_size VARCHAR(50) NOT NULL, name VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id_size))');
        $this->addSql('CREATE TABLE supplier (id_supplier INT NOT NULL, contact_name VARCHAR(50) DEFAULT NULL, address VARCHAR(50) DEFAULT NULL, supplier_country_code VARCHAR(50) DEFAULT NULL, telephone INT DEFAULT NULL, PRIMARY KEY(id_supplier))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, id_role INT DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, telephone INT DEFAULT NULL, birth_date DATE NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE INDEX IDX_8D93D649DC499668 ON "user" (id_role)');
        $this->addSql('CREATE TABLE posesses (id INT NOT NULL, id_address INT NOT NULL, PRIMARY KEY(id, id_address))');
        $this->addSql('CREATE INDEX IDX_965393B8BF396750 ON posesses (id)');
        $this->addSql('CREATE INDEX IDX_965393B8D3D3C6F1 ON posesses (id_address)');
        $this->addSql('CREATE TABLE belongs (id INT NOT NULL, id_platform INT NOT NULL, PRIMARY KEY(id, id_platform))');
        $this->addSql('CREATE INDEX IDX_47025A8EBF396750 ON belongs (id)');
        $this->addSql('CREATE INDEX IDX_47025A8E69893C5E ON belongs (id_platform)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81CBF180EB FOREIGN KEY (id_supplier) REFERENCES supplier (id_supplier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE69893C5E FOREIGN KEY (id_platform) REFERENCES pay_platform (id_platform) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE675A0085 FOREIGN KEY (id_delivery) REFERENCES delivery (id_delivery) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEBF396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADCBF180EB FOREIGN KEY (id_supplier) REFERENCES supplier (id_supplier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE associate ADD CONSTRAINT FK_CCE5D25DD7ADDD FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE associate ADD CONSTRAINT FK_CCE5D255697F554 FOREIGN KEY (id_category) REFERENCES category (id_category) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composes ADD CONSTRAINT FK_EF74364EDD7ADDD FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composes ADD CONSTRAINT FK_EF74364E1BACD2A8 FOREIGN KEY (id_order) REFERENCES orders (id_order) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE corresponds ADD CONSTRAINT FK_F606102EDD7ADDD FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE corresponds ADD CONSTRAINT FK_F606102E7CE03868 FOREIGN KEY (id_size) REFERENCES size (id_size) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649DC499668 FOREIGN KEY (id_role) REFERENCES role (id_role) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posesses ADD CONSTRAINT FK_965393B8BF396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posesses ADD CONSTRAINT FK_965393B8D3D3C6F1 FOREIGN KEY (id_address) REFERENCES address (id_address) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE belongs ADD CONSTRAINT FK_47025A8EBF396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE belongs ADD CONSTRAINT FK_47025A8E69893C5E FOREIGN KEY (id_platform) REFERENCES pay_platform (id_platform) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE posesses DROP CONSTRAINT FK_965393B8D3D3C6F1');
        $this->addSql('ALTER TABLE associate DROP CONSTRAINT FK_CCE5D255697F554');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEE675A0085');
        $this->addSql('ALTER TABLE composes DROP CONSTRAINT FK_EF74364E1BACD2A8');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEE69893C5E');
        $this->addSql('ALTER TABLE belongs DROP CONSTRAINT FK_47025A8E69893C5E');
        $this->addSql('ALTER TABLE associate DROP CONSTRAINT FK_CCE5D25DD7ADDD');
        $this->addSql('ALTER TABLE composes DROP CONSTRAINT FK_EF74364EDD7ADDD');
        $this->addSql('ALTER TABLE corresponds DROP CONSTRAINT FK_F606102EDD7ADDD');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649DC499668');
        $this->addSql('ALTER TABLE corresponds DROP CONSTRAINT FK_F606102E7CE03868');
        $this->addSql('ALTER TABLE address DROP CONSTRAINT FK_D4E6F81CBF180EB');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADCBF180EB');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEEBF396750');
        $this->addSql('ALTER TABLE posesses DROP CONSTRAINT FK_965393B8BF396750');
        $this->addSql('ALTER TABLE belongs DROP CONSTRAINT FK_47025A8EBF396750');
        $this->addSql('DROP SEQUENCE address_id_address_seq CASCADE');
        $this->addSql('DROP SEQUENCE category_id_category_seq CASCADE');
        $this->addSql('DROP SEQUENCE delivery_id_delivery_seq CASCADE');
        $this->addSql('DROP SEQUENCE message_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE orders_id_order_seq CASCADE');
        $this->addSql('DROP SEQUENCE pay_platform_id_platform_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_product_seq CASCADE');
        $this->addSql('DROP SEQUENCE role_id_role_seq CASCADE');
        $this->addSql('DROP SEQUENCE size_id_size_seq CASCADE');
        $this->addSql('DROP SEQUENCE supplier_id_supplier_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE delivery');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE pay_platform');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE associate');
        $this->addSql('DROP TABLE composes');
        $this->addSql('DROP TABLE corresponds');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE posesses');
        $this->addSql('DROP TABLE belongs');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
