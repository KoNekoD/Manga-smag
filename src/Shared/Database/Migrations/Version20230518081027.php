<?php

declare(strict_types=1);

namespace App\Shared\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230518081027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE manga_orders_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE manga_products_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE manga_orders (id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(180) NOT NULL, user_name VARCHAR(180) NOT NULL, user_phone VARCHAR(180) NOT NULL, user_comment TEXT DEFAULT NULL, user_id INT DEFAULT NULL, products_ids JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN manga_orders.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE manga_products (id INT NOT NULL, description TEXT DEFAULT NULL, image TEXT DEFAULT NULL, name VARCHAR(180) NOT NULL, code INT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE manga_orders_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manga_products_id_seq CASCADE');
        $this->addSql('DROP TABLE manga_orders');
        $this->addSql('DROP TABLE manga_products');
    }
}
