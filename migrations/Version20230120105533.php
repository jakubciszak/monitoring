<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120105533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE process_test_case (process_id UUID NOT NULL, service_id VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, "group" VARCHAR(255) NOT NULL, method VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, parameters JSON NOT NULL, PRIMARY KEY(process_id))');
        $this->addSql('COMMENT ON COLUMN process_test_case.process_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE process_test_case');
    }
}
