<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240208144721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score_board ADD category_id INT NOT NULL, ADD game_id INT NOT NULL, DROP category');
        $this->addSql('ALTER TABLE score_board ADD CONSTRAINT FK_E11AE7CF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE score_board ADD CONSTRAINT FK_E11AE7CFE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_E11AE7CF12469DE2 ON score_board (category_id)');
        $this->addSql('CREATE INDEX IDX_E11AE7CFE48FD905 ON score_board (game_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score_board DROP FOREIGN KEY FK_E11AE7CF12469DE2');
        $this->addSql('ALTER TABLE score_board DROP FOREIGN KEY FK_E11AE7CFE48FD905');
        $this->addSql('DROP INDEX IDX_E11AE7CF12469DE2 ON score_board');
        $this->addSql('DROP INDEX IDX_E11AE7CFE48FD905 ON score_board');
        $this->addSql('ALTER TABLE score_board ADD category VARCHAR(255) NOT NULL, DROP category_id, DROP game_id');
    }
}
