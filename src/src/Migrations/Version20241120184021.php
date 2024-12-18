<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120184021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE currency_subscription (id INT GENERATED BY DEFAULT AS IDENTITY NOT NULL, member_id UUID NOT NULL, is_active BOOLEAN DEFAULT true NOT NULL, created_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2A61FA37597D3FE ON currency_subscription (member_id)');
        $this->addSql('CREATE INDEX member_id_idx ON currency_subscription (member_id)');
        $this->addSql('COMMENT ON COLUMN currency_subscription.is_active IS \'Is subscription exist for member\'');
        $this->addSql('CREATE TABLE member (id UUID NOT NULL, name VARCHAR(255) DEFAULT NULL, sur_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, created_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_time TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX member_pk ON member (id)');
        $this->addSql('ALTER TABLE currency_subscription ADD CONSTRAINT FK_2A61FA37597D3FE FOREIGN KEY (member_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE currency_subscription DROP CONSTRAINT FK_2A61FA37597D3FE');
        $this->addSql('DROP TABLE currency_subscription');
        $this->addSql('DROP TABLE member');
    }
}
