<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627143338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE role_id_role_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE color_id_color_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_user_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE color RENAME COLUMN id TO id_color');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN id TO id_user');
        $this->addSql('CREATE TABLE prod_col (id_product INT NOT NULL, id_color INT NOT NULL, PRIMARY KEY(id_product, id_color))');
        $this->addSql('CREATE INDEX IDX_580BD36FDD7ADDD ON prod_col (id_product)');
        $this->addSql('CREATE INDEX IDX_580BD36F88D309D9 ON prod_col (id_color)');
        $this->addSql('CREATE TABLE prod_cat (id_product INT NOT NULL, id_category INT NOT NULL, PRIMARY KEY(id_product, id_category))');
        $this->addSql('CREATE INDEX IDX_D5E466B7DD7ADDD ON prod_cat (id_product)');
        $this->addSql('CREATE INDEX IDX_D5E466B75697F554 ON prod_cat (id_category)');
        $this->addSql('CREATE TABLE prod_ord (id_product INT NOT NULL, id_order INT NOT NULL, PRIMARY KEY(id_product, id_order))');
        $this->addSql('CREATE INDEX IDX_A0A6CE25DD7ADDD ON prod_ord (id_product)');
        $this->addSql('CREATE INDEX IDX_A0A6CE251BACD2A8 ON prod_ord (id_order)');
        $this->addSql('CREATE TABLE prod_size (id_product INT NOT NULL, id_size VARCHAR(50) NOT NULL, PRIMARY KEY(id_product, id_size))');
        $this->addSql('CREATE INDEX IDX_7A8393BADD7ADDD ON prod_size (id_product)');
        $this->addSql('CREATE INDEX IDX_7A8393BA7CE03868 ON prod_size (id_size)');
        $this->addSql('CREATE TABLE user_addr (id_user INT NOT NULL, id_address INT NOT NULL, PRIMARY KEY(id_user, id_address))');
        $this->addSql('CREATE INDEX IDX_281BDEFC6B3CA4B ON user_addr (id_user)');
        $this->addSql('CREATE INDEX IDX_281BDEFCD3D3C6F1 ON user_addr (id_address)');
        $this->addSql('CREATE TABLE user_pay (id_user INT NOT NULL, id_platform INT NOT NULL, PRIMARY KEY(id_user, id_platform))');
        $this->addSql('CREATE INDEX IDX_159943B76B3CA4B ON user_pay (id_user)');
        $this->addSql('CREATE INDEX IDX_159943B769893C5E ON user_pay (id_platform)');
        $this->addSql('ALTER TABLE prod_col ADD CONSTRAINT FK_580BD36FDD7ADDD FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prod_col ADD CONSTRAINT FK_580BD36F88D309D9 FOREIGN KEY (id_color) REFERENCES color (id_color) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prod_cat ADD CONSTRAINT FK_D5E466B7DD7ADDD FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prod_cat ADD CONSTRAINT FK_D5E466B75697F554 FOREIGN KEY (id_category) REFERENCES category (id_category) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prod_ord ADD CONSTRAINT FK_A0A6CE25DD7ADDD FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prod_ord ADD CONSTRAINT FK_A0A6CE251BACD2A8 FOREIGN KEY (id_order) REFERENCES orders (id_order) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prod_size ADD CONSTRAINT FK_7A8393BADD7ADDD FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prod_size ADD CONSTRAINT FK_7A8393BA7CE03868 FOREIGN KEY (id_size) REFERENCES size (id_size) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_addr ADD CONSTRAINT FK_281BDEFC6B3CA4B FOREIGN KEY (id_user) REFERENCES "user" (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_addr ADD CONSTRAINT FK_281BDEFCD3D3C6F1 FOREIGN KEY (id_address) REFERENCES address (id_address) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_pay ADD CONSTRAINT FK_159943B76B3CA4B FOREIGN KEY (id_user) REFERENCES "user" (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_pay ADD CONSTRAINT FK_159943B769893C5E FOREIGN KEY (id_platform) REFERENCES pay_platform (id_platform) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE associate');
        $this->addSql('DROP TABLE composes');
        $this->addSql('DROP TABLE corresponds');
        $this->addSql('DROP TABLE posesses');
        $this->addSql('DROP TABLE belongs');
        $this->addSql('DROP TABLE product_color');
        $this->addSql('ALTER TABLE address ALTER city TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE address ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE address ALTER street TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE address ALTER address_aux TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE address ALTER postal_code TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE category ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEEBF396750');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEBF396750 FOREIGN KEY (id) REFERENCES "user" (id_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE size ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER email TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE color_id_color_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_user_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE role_id_role_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE associate (id_product INT NOT NULL, id_category INT NOT NULL, PRIMARY KEY(id_product, id_category))');
        $this->addSql('CREATE INDEX idx_cce5d25dd7addd ON associate (id_product)');
        $this->addSql('CREATE INDEX idx_cce5d255697f554 ON associate (id_category)');
        $this->addSql('CREATE TABLE composes (id_product INT NOT NULL, id_order INT NOT NULL, PRIMARY KEY(id_product, id_order))');
        $this->addSql('CREATE INDEX idx_ef74364e1bacd2a8 ON composes (id_order)');
        $this->addSql('CREATE INDEX idx_ef74364edd7addd ON composes (id_product)');
        $this->addSql('CREATE TABLE corresponds (id_product INT NOT NULL, id_size VARCHAR(50) NOT NULL, PRIMARY KEY(id_product, id_size))');
        $this->addSql('CREATE INDEX idx_f606102edd7addd ON corresponds (id_product)');
        $this->addSql('CREATE INDEX idx_f606102e7ce03868 ON corresponds (id_size)');
        $this->addSql('CREATE TABLE posesses (id INT NOT NULL, id_address INT NOT NULL, PRIMARY KEY(id, id_address))');
        $this->addSql('CREATE INDEX idx_965393b8d3d3c6f1 ON posesses (id_address)');
        $this->addSql('CREATE INDEX idx_965393b8bf396750 ON posesses (id)');
        $this->addSql('CREATE TABLE belongs (id INT NOT NULL, id_platform INT NOT NULL, PRIMARY KEY(id, id_platform))');
        $this->addSql('CREATE INDEX idx_47025a8e69893c5e ON belongs (id_platform)');
        $this->addSql('CREATE INDEX idx_47025a8ebf396750 ON belongs (id)');
        $this->addSql('CREATE TABLE product_color (id_product INT NOT NULL, id_color INT NOT NULL, PRIMARY KEY(id_product, id_color))');
        $this->addSql('CREATE INDEX idx_c70a33b588d309d9 ON product_color (id_color)');
        $this->addSql('CREATE INDEX idx_c70a33b5dd7addd ON product_color (id_product)');
        $this->addSql('ALTER TABLE associate ADD CONSTRAINT fk_cce5d25dd7addd FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE associate ADD CONSTRAINT fk_cce5d255697f554 FOREIGN KEY (id_category) REFERENCES category (id_category) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composes ADD CONSTRAINT fk_ef74364edd7addd FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE composes ADD CONSTRAINT fk_ef74364e1bacd2a8 FOREIGN KEY (id_order) REFERENCES orders (id_order) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE corresponds ADD CONSTRAINT fk_f606102edd7addd FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE corresponds ADD CONSTRAINT fk_f606102e7ce03868 FOREIGN KEY (id_size) REFERENCES size (id_size) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posesses ADD CONSTRAINT fk_965393b8bf396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE posesses ADD CONSTRAINT fk_965393b8d3d3c6f1 FOREIGN KEY (id_address) REFERENCES address (id_address) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE belongs ADD CONSTRAINT fk_47025a8ebf396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE belongs ADD CONSTRAINT fk_47025a8e69893c5e FOREIGN KEY (id_platform) REFERENCES pay_platform (id_platform) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT fk_c70a33b5dd7addd FOREIGN KEY (id_product) REFERENCES product (id_product) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT fk_c70a33b588d309d9 FOREIGN KEY (id_color) REFERENCES color (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE prod_col');
        $this->addSql('DROP TABLE prod_cat');
        $this->addSql('DROP TABLE prod_ord');
        $this->addSql('DROP TABLE prod_size');
        $this->addSql('DROP TABLE user_addr');
        $this->addSql('DROP TABLE user_pay');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT fk_e52ffdeebf396750');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT fk_e52ffdeebf396750 FOREIGN KEY (id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ALTER name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE size ALTER name TYPE VARCHAR(50)');
        $this->addSql('DROP INDEX user_pkey');
        $this->addSql('ALTER TABLE "user" ALTER email TYPE VARCHAR(180)');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN id_user TO id');
        $this->addSql('ALTER TABLE "user" ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX color_pkey');
        $this->addSql('ALTER TABLE color RENAME COLUMN id_color TO id');
        $this->addSql('ALTER TABLE color ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE address ALTER city TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE address ALTER name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE address ALTER street TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE address ALTER address_aux TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE address ALTER postal_code TYPE VARCHAR(50)');
    }
}
