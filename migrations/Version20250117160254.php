<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Enum\PrizeState;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250117160254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prize_number (id SERIAL NOT NULL, prize_id INT NOT NULL, number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DB6A432EBBE43214 ON prize_number (prize_id)');
        $this->addSql('ALTER TABLE prize_number ADD CONSTRAINT FK_DB6A432EBBE43214 FOREIGN KEY (prize_id) REFERENCES prize (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prize ADD state VARCHAR(255)');
        $this->addSql(sprintf(
                'UPDATE prize SET state = \'%s\'', PrizeState::PENDING->value)
        );
        $this->addSql('ALTER TABLE prize ALTER COLUMN state SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE prize_number DROP CONSTRAINT FK_DB6A432EBBE43214');
        $this->addSql('DROP TABLE prize_number');
        $this->addSql('ALTER TABLE prize DROP state');
    }
}
