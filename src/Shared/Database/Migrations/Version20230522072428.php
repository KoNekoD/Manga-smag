<?php

declare(strict_types=1);

namespace App\Shared\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522072428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manga_orders_products (id VARCHAR(255) NOT NULL, order_id INT DEFAULT NULL, product_id INT DEFAULT NULL, count INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2834115C8D9F6D38 ON manga_orders_products (order_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2834115C4584665A ON manga_orders_products (product_id)');
        $this->addSql('ALTER TABLE manga_orders_products ADD CONSTRAINT FK_2834115C8D9F6D38 FOREIGN KEY (order_id) REFERENCES manga_orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE manga_orders_products ADD CONSTRAINT FK_2834115C4584665A FOREIGN KEY (product_id) REFERENCES manga_products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE manga_orders DROP products_ids');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE manga_orders_products DROP CONSTRAINT FK_2834115C8D9F6D38');
        $this->addSql('ALTER TABLE manga_orders_products DROP CONSTRAINT FK_2834115C4584665A');
        $this->addSql('DROP TABLE manga_orders_products');
        $this->addSql('ALTER TABLE manga_orders ADD products_ids JSON NOT NULL');
    }
}
