<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Enum\WinningCondition;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250117080122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prize ADD winning_condition VARCHAR(255)');
        $this->addSql(sprintf(
            'UPDATE prize SET winning_condition = \'%s\'', WinningCondition::LINE->value)
        );
        $this->addSql('ALTER TABLE prize ALTER COLUMN winning_condition SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE prize DROP winning_condition');
    }
}
