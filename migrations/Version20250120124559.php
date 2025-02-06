<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120124559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prize ADD slug VARCHAR(255)');
        $this->addSql("
            UPDATE prize
            SET slug = lower(
                regexp_replace(
                    regexp_replace(
                        title, '[^a-zA-Z0-9\s]', '', 'g' -- Supprime les caractères spéciaux
                    ), '\s+', '-', 'g' -- Remplace les espaces par des tirets
                )
            )
        ");
        $this->addSql('ALTER TABLE prize ALTER COLUMN slug SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE prize DROP slug');
    }
}
