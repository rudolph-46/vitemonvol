<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103225746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE circuit (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, nbr_de_place INT NOT NULL, description VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE circuit_ville (circuit_id INT NOT NULL, ville_id INT NOT NULL, INDEX IDX_80A6AF04CF2182C8 (circuit_id), INDEX IDX_80A6AF04A73F0036 (ville_id), PRIMARY KEY(circuit_id, ville_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, country_id INT NOT NULL, nom VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, INDEX IDX_43C3D9C3F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE circuit_ville ADD CONSTRAINT FK_80A6AF04CF2182C8 FOREIGN KEY (circuit_id) REFERENCES circuit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE circuit_ville ADD CONSTRAINT FK_80A6AF04A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3F92F3E70 FOREIGN KEY (country_id) REFERENCES pays (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE circuit_ville DROP FOREIGN KEY FK_80A6AF04CF2182C8');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3F92F3E70');
        $this->addSql('ALTER TABLE circuit_ville DROP FOREIGN KEY FK_80A6AF04A73F0036');
        $this->addSql('DROP TABLE circuit');
        $this->addSql('DROP TABLE circuit_ville');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE ville');
    }
}
