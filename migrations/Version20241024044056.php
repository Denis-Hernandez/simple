<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024044056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jornada (id INT AUTO_INCREMENT NOT NULL, equipo1_id INT NOT NULL, equipo2_id INT NOT NULL, fecha DATE NOT NULL, INDEX IDX_61D21CBF8D588AD (equipo1_id), INDEX IDX_61D21CBF1A602743 (equipo2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, equipo_id INT NOT NULL, nombre VARCHAR(50) NOT NULL, apellido VARCHAR(50) NOT NULL, fecha_nac DATE NOT NULL, INDEX IDX_2265B05D23BFBED (equipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jornada ADD CONSTRAINT FK_61D21CBF8D588AD FOREIGN KEY (equipo1_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE jornada ADD CONSTRAINT FK_61D21CBF1A602743 FOREIGN KEY (equipo2_id) REFERENCES equipo (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D23BFBED FOREIGN KEY (equipo_id) REFERENCES equipo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jornada DROP FOREIGN KEY FK_61D21CBF8D588AD');
        $this->addSql('ALTER TABLE jornada DROP FOREIGN KEY FK_61D21CBF1A602743');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D23BFBED');
        $this->addSql('DROP TABLE equipo');
        $this->addSql('DROP TABLE jornada');
        $this->addSql('DROP TABLE usuario');
    }
}
