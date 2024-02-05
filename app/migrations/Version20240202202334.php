<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202202334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rules (id INT AUTO_INCREMENT NOT NULL, descripÃtion LONGTEXT NOT NULL, bosses LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score_board (id INT AUTO_INCREMENT NOT NULL, player VARCHAR(255) NOT NULL, points VARCHAR(255) DEFAULT NULL, time DATETIME DEFAULT NULL, event_name VARCHAR(255) NOT NULL, link LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE score_record');
        $this->addSql('ALTER TABLE category ADD name VARCHAR(255) NOT NULL, ADD rules LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', DROP game_name');
        $this->addSql('ALTER TABLE game ADD image LONGTEXT DEFAULT NULL, CHANGE name name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score_record (id INT AUTO_INCREMENT NOT NULL, game_name LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, game_category LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE rules');
        $this->addSql('DROP TABLE score_board');
        $this->addSql('ALTER TABLE category ADD game_name LONGTEXT NOT NULL, DROP name, DROP rules');
        $this->addSql('ALTER TABLE game DROP image, CHANGE name name LONGTEXT NOT NULL');
    }
}
