<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404003232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gouvernorat (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_4457C12B98260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pts (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, logitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, altitude DOUBLE PRECISION NOT NULL, INDEX IDX_29EF2D3698260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gouvernorat ADD CONSTRAINT FK_4457C12B98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE pts ADD CONSTRAINT FK_29EF2D3698260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE demande_installation ADD region_id INT NOT NULL');
        $this->addSql('ALTER TABLE demande_installation ADD CONSTRAINT FK_4B73F8CB98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_4B73F8CB98260155 ON demande_installation (region_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3F85E0677 ON utilisateur (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_installation DROP FOREIGN KEY FK_4B73F8CB98260155');
        $this->addSql('ALTER TABLE gouvernorat DROP FOREIGN KEY FK_4457C12B98260155');
        $this->addSql('ALTER TABLE pts DROP FOREIGN KEY FK_29EF2D3698260155');
        $this->addSql('DROP TABLE gouvernorat');
        $this->addSql('DROP TABLE pts');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP INDEX IDX_4B73F8CB98260155 ON demande_installation');
        $this->addSql('ALTER TABLE demande_installation DROP region_id');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3F85E0677 ON utilisateur');
    }
}
