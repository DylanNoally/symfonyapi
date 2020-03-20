<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309091153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE entite (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, resume LONGTEXT DEFAULT NULL, texte_long LONGTEXT DEFAULT NULL, date_de_publication DATETIME DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, photo_additionnelle VARCHAR(255) DEFAULT NULL, etat TINYINT(1) DEFAULT NULL, fichier_pdf VARCHAR(255) DEFAULT NULL, liens VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, complement_adresse VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, fax INT DEFAULT NULL, site_web VARCHAR(255) DEFAULT NULL, email_general VARCHAR(255) DEFAULT NULL, email_alertes VARCHAR(255) DEFAULT NULL, url_facebook VARCHAR(255) DEFAULT NULL, url_twitter VARCHAR(255) DEFAULT NULL, url_instagram VARCHAR(255) DEFAULT NULL, url_youtube VARCHAR(255) DEFAULT NULL, url_linkedin VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP INDEX clé étrangère de categorie ON diaporama');
        $this->addSql('ALTER TABLE diaporama DROP date_debut_affichage, DROP date_fin_affichage, DROP libelle_bouton, DROP url_bouton, DROP case_nouvel_onglet, DROP image, DROP id_categorie');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE entite');
        $this->addSql('ALTER TABLE diaporama ADD date_debut_affichage DATETIME NOT NULL, ADD date_fin_affichage DATETIME DEFAULT NULL, ADD libelle_bouton VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD url_bouton VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD case_nouvel_onglet TINYINT(1) DEFAULT NULL, ADD image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD id_categorie INT NOT NULL');
        $this->addSql('CREATE INDEX clé étrangère de categorie ON diaporama (id_categorie)');
    }
}
