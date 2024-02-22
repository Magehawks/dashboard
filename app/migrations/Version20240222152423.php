<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222152423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score_board ADD player_id INT DEFAULT NULL, DROP player');
        $this->addSql('ALTER TABLE score_board ADD CONSTRAINT FK_E11AE7CF99E6F5DF FOREIGN KEY (player_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_E11AE7CF99E6F5DF ON score_board (player_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score_board DROP FOREIGN KEY FK_E11AE7CF99E6F5DF');
        $this->addSql('DROP INDEX IDX_E11AE7CF99E6F5DF ON score_board');
        $this->addSql('ALTER TABLE score_board ADD player VARCHAR(255) NOT NULL, DROP player_id');
    }
}
