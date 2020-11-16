<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116101643 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE testeasyadmin (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE EXPOSITION CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE lieu lieu VARCHAR(255) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE oeuvre CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE technique technique VARCHAR(255) NOT NULL, CHANGE support support VARCHAR(255) NOT NULL, CHANGE petiteimage petiteimage VARCHAR(255) NOT NULL, CHANGE grande_image grande_image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE oeuvre_EXPOSEE DROP FOREIGN KEY oeuvre_exposee_ibfk_1');
        $this->addSql('ALTER TABLE oeuvre_EXPOSEE DROP FOREIGN KEY oeuvre_exposee_ibfk_2');
        $this->addSql('DROP INDEX id_exposition ON oeuvre_EXPOSEE');
        $this->addSql('DROP INDEX IDX_32D6FC7713C99B13 ON oeuvre_EXPOSEE');
        $this->addSql('ALTER TABLE oeuvre_EXPOSEE ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE testeasyadmin');
        $this->addSql('ALTER TABLE exposition CHANGE nom nom VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE lieu lieu VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE adresse adresse VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE oeuvre CHANGE titre titre VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE technique technique VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE support support VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE petiteimage petiteimage VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, CHANGE grande_image grande_image VARCHAR(20) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`');
        $this->addSql('ALTER TABLE oeuvre_exposee MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE oeuvre_exposee DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE oeuvre_exposee DROP id');
        $this->addSql('ALTER TABLE oeuvre_exposee ADD CONSTRAINT oeuvre_exposee_ibfk_1 FOREIGN KEY (id_oeuvre) REFERENCES oeuvre (id)');
        $this->addSql('ALTER TABLE oeuvre_exposee ADD CONSTRAINT oeuvre_exposee_ibfk_2 FOREIGN KEY (id_exposition) REFERENCES exposition (id)');
        $this->addSql('CREATE INDEX id_exposition ON oeuvre_exposee (id_exposition)');
        $this->addSql('CREATE INDEX IDX_32D6FC7713C99B13 ON oeuvre_exposee (id_oeuvre)');
        $this->addSql('ALTER TABLE oeuvre_exposee ADD PRIMARY KEY (id_oeuvre, id_exposition)');
    }
}
