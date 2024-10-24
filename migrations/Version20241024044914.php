<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024044914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gol (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, jornada_id INT NOT NULL, cantidad INT NOT NULL, INDEX IDX_14B85EACDB38439E (usuario_id), INDEX IDX_14B85EAC26E992D9 (jornada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incidente (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, tipo VARCHAR(10) NOT NULL, descripcion VARCHAR(255) NOT NULL, fechaincidente DATE NOT NULL, fechasuspencion DATE DEFAULT NULL, INDEX IDX_12858081DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gol ADD CONSTRAINT FK_14B85EACDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE gol ADD CONSTRAINT FK_14B85EAC26E992D9 FOREIGN KEY (jornada_id) REFERENCES jornada (id)');
        $this->addSql('ALTER TABLE incidente ADD CONSTRAINT FK_12858081DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gol DROP FOREIGN KEY FK_14B85EACDB38439E');
        $this->addSql('ALTER TABLE gol DROP FOREIGN KEY FK_14B85EAC26E992D9');
        $this->addSql('ALTER TABLE incidente DROP FOREIGN KEY FK_12858081DB38439E');
        $this->addSql('DROP TABLE gol');
        $this->addSql('DROP TABLE incidente');
    }
}
