<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240207204139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D6492882160E ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649AB2E1400 ON user');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) DEFAULT NULL, CHANGE steam_username steam_username VARCHAR(180) DEFAULT NULL, CHANGE living_city living_city VARCHAR(180) DEFAULT NULL, CHANGE living_country living_country VARCHAR(180) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL, CHANGE steam_username steam_username VARCHAR(180) NOT NULL, CHANGE living_city living_city VARCHAR(180) NOT NULL, CHANGE living_country living_country VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6492882160E ON user (living_city)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AB2E1400 ON user (living_country)');
    }
}
