<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116102317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE oe (id INT AUTO_INCREMENT NOT NULL, nom_entier VARCHAR(255) NOT NULL, age_entier INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oeuvre_EXPOSEE ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE oe');
        $this->addSql('ALTER TABLE oeuvre_exposee MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvre_exposee DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE oeuvre_exposee DROP id');
        $this->addSql('ALTER TABLE oeuvre_exposee ADD PRIMARY KEY (id_oeuvre, id_exposition)');
    }
}
