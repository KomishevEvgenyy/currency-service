<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120184112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO public.member (id, name, sur_name, email, created_time, updated_time)
            VALUES
                (gen_random_uuid(), 'Carlos', 'Gomez', 'carlos.gomez@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Maria', 'Fernandez', 'maria.fernandez@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Juan', 'Perez', 'juan.perez@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Ana', 'Lopez', 'ana.lopez@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Luis', 'Garcia', 'luis.garcia@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Sofia', 'Martinez', 'sofia.martinez@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Diego', 'Hernandez', 'diego.hernandez@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Camila', 'Rodriguez', 'camila.rodriguez@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Javier', 'Torres', 'javier.torres@example.com', NOW(), NOW()),
                (gen_random_uuid(), 'Isabella', 'Morales', 'isabella.morales@example.com', NOW(), NOW());");
        $this->addSql("INSERT INTO public.currency_subscription (member_id, is_active, created_time, updated_time)
            SELECT id, 
               (random() < 0.4), -- Генеруємо 80% активних підписок
               NOW(),
               NOW()
            FROM public.member;");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
