<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251204204124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animaux (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE animaux_produit (animaux_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_A6454ECFA9DAECAA (animaux_id), INDEX IDX_A6454ECFF347EFB (produit_id), PRIMARY KEY (animaux_id, produit_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE animaux_produit ADD CONSTRAINT FK_A6454ECFA9DAECAA FOREIGN KEY (animaux_id) REFERENCES animaux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE animaux_produit ADD CONSTRAINT FK_A6454ECFF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27BCF5E72D ON produit (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animaux_produit DROP FOREIGN KEY FK_A6454ECFA9DAECAA');
        $this->addSql('ALTER TABLE animaux_produit DROP FOREIGN KEY FK_A6454ECFF347EFB');
        $this->addSql('DROP TABLE animaux');
        $this->addSql('DROP TABLE animaux_produit');
        $this->addSql('ALTER TABLE categorie DROP description');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('DROP INDEX IDX_29A5EC27BCF5E72D ON produit');
        $this->addSql('ALTER TABLE produit DROP categorie_id');
    }
}
