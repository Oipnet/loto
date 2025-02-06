<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250118085647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game ADD owner_id INT');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_232B318C7E3C61F9 ON game (owner_id)');

        $this->addSql(
            sprintf(
            'UPDATE game SET owner_id = (SELECT id FROM "user" WHERE username = \'%s\')', 'ape_barsacaise'
            )
        );
        $this->addSql('ALTER TABLE game ALTER COLUMN owner_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE game DROP CONSTRAINT FK_232B318C7E3C61F9');
        $this->addSql('DROP INDEX IDX_232B318C7E3C61F9');
        $this->addSql('ALTER TABLE game DROP owner_id');
    }
}
