<?php

declare(strict_types=1);

namespace App\Shared\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230526125515 extends AbstractMigration
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
        $this->addSql('CREATE SEQUENCE manga_users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE manga_orders (id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(180) NOT NULL, user_name VARCHAR(180) NOT NULL, user_phone VARCHAR(180) NOT NULL, user_comment TEXT DEFAULT NULL, user_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN manga_orders.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE manga_orders_products (id VARCHAR(255) NOT NULL, order_id INT DEFAULT NULL, product_id INT DEFAULT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2834115C8D9F6D38 ON manga_orders_products (order_id)');
        $this->addSql('CREATE INDEX IDX_2834115C4584665A ON manga_orders_products (product_id)');
        $this->addSql('CREATE TABLE manga_products (id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, name VARCHAR(180) NOT NULL, code INT NOT NULL, price DOUBLE PRECISION NOT NULL, description TEXT DEFAULT NULL, image TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN manga_products.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE manga_users (id INT NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_82D5598EE7927C74 ON manga_users (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE manga_orders_products ADD CONSTRAINT FK_2834115C8D9F6D38 FOREIGN KEY (order_id) REFERENCES manga_orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE manga_orders_products ADD CONSTRAINT FK_2834115C4584665A FOREIGN KEY (product_id) REFERENCES manga_products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE manga_orders_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manga_products_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manga_users_id_seq CASCADE');
        $this->addSql('ALTER TABLE manga_orders_products DROP CONSTRAINT FK_2834115C8D9F6D38');
        $this->addSql('ALTER TABLE manga_orders_products DROP CONSTRAINT FK_2834115C4584665A');
        $this->addSql('DROP TABLE manga_orders');
        $this->addSql('DROP TABLE manga_orders_products');
        $this->addSql('DROP TABLE manga_products');
        $this->addSql('DROP TABLE manga_users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
