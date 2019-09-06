<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906041454 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nfl_team ADD bye_week_id INT NOT NULL');
        $this->addSql('ALTER TABLE nfl_team ADD CONSTRAINT FK_68F4FA07A692F197 FOREIGN KEY (bye_week_id) REFERENCES week (id)');
        $this->addSql('CREATE INDEX IDX_68F4FA07A692F197 ON nfl_team (bye_week_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nfl_team DROP FOREIGN KEY FK_68F4FA07A692F197');
        $this->addSql('DROP INDEX IDX_68F4FA07A692F197 ON nfl_team');
        $this->addSql('ALTER TABLE nfl_team DROP bye_week_id');
    }
}
