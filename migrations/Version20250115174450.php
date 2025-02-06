<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250115174450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, state VARCHAR(255) DEFAULT \'En préparation\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN game.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE prize (id SERIAL NOT NULL, game_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, sort INT NOT NULL, price INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_51C88BC1E48FD905 ON prize (game_id)');
        $this->addSql('ALTER TABLE prize ADD CONSTRAINT FK_51C88BC1E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE prize DROP CONSTRAINT FK_51C88BC1E48FD905');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE prize');
    }
}
