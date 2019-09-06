<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906022720 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE week (id INT AUTO_INCREMENT NOT NULL, start_date DATETIME NOT NULL, name VARCHAR(255) NOT NULL, value INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE position (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(8) NOT NULL, min_starters INT NOT NULL, max_starters INT NOT NULL, min_on_roster INT NOT NULL, max_on_roster INT NOT NULL, weight INT NOT NULL, flex_eligible TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roster_item (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, roster_id INT NOT NULL, is_starter TINYINT(1) NOT NULL, is_flex TINYINT(1) NOT NULL, INDEX IDX_176908C999E6F5DF (player_id), INDEX IDX_176908C975404483 (roster_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nfl_game (id INT AUTO_INCREMENT NOT NULL, home_team_id INT NOT NULL, away_team_id INT NOT NULL, week_id INT NOT NULL, kickoff DATETIME NOT NULL, seconds_remaining INT NOT NULL, INDEX IDX_8F3F6D949C4C13F6 (home_team_id), INDEX IDX_8F3F6D9445185D02 (away_team_id), INDEX IDX_8F3F6D94C86F3B2F (week_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nfl_team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, short_name VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE franchise (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, api_key VARCHAR(255) NOT NULL, login_cookie VARCHAR(255) NOT NULL, mfl_id VARCHAR(4) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roster (id INT AUTO_INCREMENT NOT NULL, franchise_id INT NOT NULL, week_id INT NOT NULL, INDEX IDX_60B9ADF9523CAB89 (franchise_id), INDEX IDX_60B9ADF9C86F3B2F (week_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, position_id INT NOT NULL, nfl_team_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, mfl_id VARCHAR(5) NOT NULL, INDEX IDX_98197A65DD842E46 (position_id), INDEX IDX_98197A65378DECEF (nfl_team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE roster_item ADD CONSTRAINT FK_176908C999E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE roster_item ADD CONSTRAINT FK_176908C975404483 FOREIGN KEY (roster_id) REFERENCES roster (id)');
        $this->addSql('ALTER TABLE nfl_game ADD CONSTRAINT FK_8F3F6D949C4C13F6 FOREIGN KEY (home_team_id) REFERENCES nfl_team (id)');
        $this->addSql('ALTER TABLE nfl_game ADD CONSTRAINT FK_8F3F6D9445185D02 FOREIGN KEY (away_team_id) REFERENCES nfl_team (id)');
        $this->addSql('ALTER TABLE nfl_game ADD CONSTRAINT FK_8F3F6D94C86F3B2F FOREIGN KEY (week_id) REFERENCES week (id)');
        $this->addSql('ALTER TABLE roster ADD CONSTRAINT FK_60B9ADF9523CAB89 FOREIGN KEY (franchise_id) REFERENCES franchise (id)');
        $this->addSql('ALTER TABLE roster ADD CONSTRAINT FK_60B9ADF9C86F3B2F FOREIGN KEY (week_id) REFERENCES week (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65378DECEF FOREIGN KEY (nfl_team_id) REFERENCES nfl_team (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nfl_game DROP FOREIGN KEY FK_8F3F6D94C86F3B2F');
        $this->addSql('ALTER TABLE roster DROP FOREIGN KEY FK_60B9ADF9C86F3B2F');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65DD842E46');
        $this->addSql('ALTER TABLE nfl_game DROP FOREIGN KEY FK_8F3F6D949C4C13F6');
        $this->addSql('ALTER TABLE nfl_game DROP FOREIGN KEY FK_8F3F6D9445185D02');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65378DECEF');
        $this->addSql('ALTER TABLE roster DROP FOREIGN KEY FK_60B9ADF9523CAB89');
        $this->addSql('ALTER TABLE roster_item DROP FOREIGN KEY FK_176908C975404483');
        $this->addSql('ALTER TABLE roster_item DROP FOREIGN KEY FK_176908C999E6F5DF');
        $this->addSql('DROP TABLE week');
        $this->addSql('DROP TABLE position');
        $this->addSql('DROP TABLE roster_item');
        $this->addSql('DROP TABLE nfl_game');
        $this->addSql('DROP TABLE nfl_team');
        $this->addSql('DROP TABLE franchise');
        $this->addSql('DROP TABLE roster');
        $this->addSql('DROP TABLE player');
    }
}
